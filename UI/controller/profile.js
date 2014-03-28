var Profile = portal.controller('ProfileCtrl', ['$scope', 'ui', 'Item', '$rootScope', function($scope, $ui, $item, $root) {
    $scope.ui = {
        profile: {
            placeholder : {
            },
            userdata: {
            },
            submit: function() {                    
                
             
                input = {};
                
                error = false;
 
                
                
                if($scope.ui.profile.userdata.newpassword1 !== $scope.ui.profile.userdata.newpassword2) {
                    $scope.ui.profile.response = {Error : "Passwords don't match"};
                    return false;
                } else if (typeof $scope.ui.profile.userdata.newpassword1 === "undefined") {
                    //Nothing
                } else if ($scope.ui.profile.userdata.newpassword1.length === 0) { 
                    //Nothing
                //} else if(!/#.*^(?=.{8,64})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#/.test($scope.ui.profile.userdata.newpassword1)) {
                //    $scope.ui.profile.response = {Error : "Password must be between 8 and 64 characters, have at least one lowercase letter, one uppercase letter and one number"};
                } else {
                    input["password"] = $scope.ui.profile.userdata.newpassword1;
                }
                if($scope.ui.profile.userdata.mail !== "")   {
                    input["mail"] = $scope.ui.profile.userdata.mail;
                }
                if($scope.ui.profile.userdata.name !== "")   {
                    input["name"] = $scope.ui.profile.userdata.name;
                }
                $item.resolver.user.profile.edit(input, function(data) {
                    $scope.ui.profile.status = data.status;
                    $scope.ui.profile.message = data.message;                       
                    $scope.ui.profile.response = data;
                    if(typeof data.user !== "undefined") {
                        $ui.user.data = data.user;
                        $ui.user.data.signedin = true;
                        $root.user = data.user;
                        $root.user.signedin = true;
                        $root.$broadcast("USER_UPDATE", $ui.user.data);
                    }
                    $scope.ui.profile.userdata.newpassword1 = "";
                    $scope.ui.profile.userdata.newpassword2 = "";
                });           
            },
            message: false,
            status: false            
        }
    };
    $scope.ui.profile.placeholder =  $ui.user.data;
    $ui.title("Profile");
}]);
Profile.resolveProfile = {
    itemData: function(ui) {
        this.data = ui.user.signedin();
        return this.data;
    },
    delay: function($q, $timeout) {
        var delay = $q.defer();
        $timeout(delay.resolve, 1000);
        return delay.promise;
    }
};

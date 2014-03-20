var Profile = portal.controller('ProfileCtrl', ['$scope', 'ui', 'Item', '$rootScope', '$window', function($scope, $ui, $item, $root, $window) {

        $scope.ui = {
            profile: {
                userdata: {
                },
                submit: function() {
                    console.log('submit profile');
                    console.log($scope.ui);
                    
                    input = $scope.ui.profile.userdata;
                    
                    error = false;
                    
                    if($scope.ui.profile.userdata.newpassword1 !== $scope.ui.profile.userdata.newpassword2)
                    {
                        $scope.ui.profile.response = {Error : "Passwords don't match"};
                        exit;
                    }
                    else
                        $scope.ui.profile.response = {Success : false, Error : false};
                                        
                    $item.resolver.user.profile.edit($scope.ui.profile.userdata, function(data) {
                        $scope.ui.profile.response = data;
                    });                    
                },
                response: {
                    Success : false,
                    Error : false,
                }
            }
        };
        $ui.user.signedin(function(data) {
            $scope.ui.profile.userdata = data;
            $scope.ui.profile.userdata.newpassword1 = "";
            $scope.ui.profile.userdata.newpassword2 = "";
        });
        $ui.title("Profile");

        //exec
    }]);

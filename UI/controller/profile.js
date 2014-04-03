var Profile = portal.controller('ProfileCtrl', ['$scope', 'ui', 'Item', '$rootScope', function($scope, $ui, $item, $root) {

        //redirect if not logged in
        if (!$ui.user.data) {
            window.location = "#/login";
        }

        $scope.ui = {
            profile: {
                placeholder: {
                },
                userdata: {
                },
                submit: function() {

                    input = {};
                    error = false;

                    if ($scope.ui.profile.userdata.newpassword1 !== $scope.ui.profile.userdata.newpassword2) {
                        $scope.ui.profile.response = {Error: "Passwords don't match"};
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
                    if ($scope.ui.profile.userdata.mail !== "") {
                        input["mail"] = $scope.ui.profile.userdata.mail;
                    }
                    if ($scope.ui.profile.userdata.name !== "") {
                        input["name"] = $scope.ui.profile.userdata.name;
                    }
                    if ($scope.ui.profile.userdata.login !== "") {
                        input["login"] = $scope.ui.profile.userdata.login;
                    }
                    $item.resolver.user.profile.edit(input, function(data) {
                        $scope.ui.profile.status = data.status;
                        $scope.ui.profile.message = data.message;
                        $scope.ui.profile.response = data;
                        if (typeof data.user !== "undefined") {
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
                apply: function() {

                    input = {};
                    domain = $scope.ui.profile.apply.domain;

                    if (!domain || domain.length === 0) {
                        $scope.ui.profile.apply.message = "Domain is mandatory";
                        $scope.ui.profile.apply.status = "error";

                        return false;
                    }
                    else {
                        
                        console.log(domain);
                        
                        //check if domain is already applied for
                        for (index = 0; index < $scope.ui.profile.placeholder.keys.length; ++index) {
                            if (domain === $scope.ui.profile.placeholder.keys[index]["domain"]) {
                                $scope.ui.profile.apply.message = "Domain already applied for";
                                $scope.ui.profile.apply.status = "error";

                                return false;
                            }
                        }
                        
                        input['domain'] = $scope.ui.profile.apply.domain;

                        $item.resolver.user.profile.apply_for_key(input, function(data) {
                            $scope.ui.profile.apply.status = data.status;
                            $scope.ui.profile.apply.message = data.message;

                            if (data.status === 'success') {
                                key = {};
                                key['domain'] = domain;
                                key['private_key'] = 'application pending';
                                key['public_key'] = 'application pending';
                                $scope.ui.profile.placeholder.keys.push(key);

                                //reset domain text
                                $scope.ui.profile.apply.domain = '';
                            }
                        });
                    }
                },
                message: false,
                status: false
            }
        };
        $scope.ui.profile.placeholder = $ui.user.data;

        console.log($ui.user.data);

        for (index = 0; index < $scope.ui.profile.placeholder.keys.length; ++index) {
            if (!$scope.ui.profile.placeholder.keys[index]["public_key"] ||
                    $scope.ui.profile.placeholder.keys[index]["public_key"].length === 0) {
                $scope.ui.profile.placeholder.keys[index]["public_key"] = 'application pending';
                $scope.ui.profile.placeholder.keys[index]["private_key"] = 'application pending';
            }
        }
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

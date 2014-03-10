var Login = portal.controller('LoginCtrl', ['$scope', 'ui',  'Item', '$rootScope', '$window', function($scope, $ui, $item, $root, $window) {

	$scope.ui = {
		login : {
			submit : function() {
			
				$item.resolver.user.signin($scope.ui.login.inputs, function(data) {
					if(data.error || data.signin == false) {
                                            $scope.ui.login.status =  data.status;
                                            $scope.ui.login.message =  data.message;
					} else {
						o = {name : data.Name, mail: data.Mail, signedin : true };
						$root.user = o;
						$scope.ui.user =  o;
                                                $window.location.href = '/';
					}
				});
				
			},
			message : false,
			status : false,                        
			inputs : {}
		},
		signup : {
			submit : function () {
				$item.resolver.user.signup($scope.ui.signup.inputs, function(data) {
					$scope.ui.signup.message = data.message;
					$scope.ui.signup.status = data.status;
				});
			},
			message : false,
			status : false,
			data : { }
		},
		user : {
			name : false,
			mail : false,
			signedin : false,
			oAuth : function(provider) {
				$item.resolver.oAuth(provider, $window.location.href, function(data) {
					$window.location.href = data.popup;
				});
			}
		}
	};
	
	$ui.title("Login");
	
	//exec
}]);
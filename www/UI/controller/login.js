var Login = portal.controller('LoginCtrl', ['$scope', 'ui',  'Item', '$rootScope', '$window', function($scope, $ui, $item, $root, $window) {

	$scope.ui = {
		login : {
			submit : function() {
			
				$item.resolver.user.signin($scope.ui.login.inputs, function(data) {
					if(data.error || data.signin == false) {
					} else {
						o = {name : data.Name, mail: data.Mail, signedin : true };
						$root.user = o;
						$scope.ui.user =  o;
					}
				});
				
			},
			inputs : {}
		},
		signup : {
			submit : function () {
				//if(isset($post["mail"]) && isset($post["password"]) && isset($post["name"]) && isset($post["user"]))
				$item.resolver.user.signup($scope.ui.signup.inputs, function(data) {
					if(data.Error) {
						$scope.ui.signup.message.error = data.Error;
						$scope.ui.signup.message.success = false;
					} else {
						$scope.ui.signup.message.success = data.Success;
						$scope.ui.signup.message.error = false;
					}
				});
			},
			message : {},
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
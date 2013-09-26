var Login = portal.controller('LoginCtrl', ['$scope', 'ui',  'Item', '$rootScope', function($scope, $ui, $item, $root) {

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
			signedin : false
		}
	};
	
	$ui.title("Login");
	
	//exec
}]);
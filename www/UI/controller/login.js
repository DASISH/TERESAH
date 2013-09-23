var Login = portal.controller('LoginCtrl', ['$scope', 'ui',  'Item', '$rootScope', function($scope, $ui, $item, $root) {

	$scope.ui = {
		login : {
			submit : function() {
			
				$item.resolver.user.signin($scope.ui.login.inputs, function(data) {
					$root.user = {name : data.name, mail: data.mail, signedin : true }
				});
				
			},
			inputs : {}
		}
	};
	
	$ui.title("Login");
	
	//exec
}]);
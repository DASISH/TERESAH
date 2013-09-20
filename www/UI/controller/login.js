var Login = portal.controller('LoginCtrl', ['$scope', 'ui',  'Item', function($scope, $ui, $item) {

	$scope.ui = {
		login : {
			submit : function() {
			
				$item.resolver.user.signin($scope.ui.login.inputs, function(data) {
					console.log(data);
				});
				
			},
			inputs : {}
		}
	};
	
	$ui.title("Login");
	
	//exec
}]);
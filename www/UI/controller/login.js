var Login = portal.controller('LoginCtrl', ['$scope', 'ui',  'Item', '$rootScope', function($scope, $ui, $item, $root) {

	$scope.ui = {
		login : {
			submit : function() {
			
				$item.resolver.user.signin($scope.ui.login.inputs, function(data) {
					o = {name : data.name, mail: data.mail, signedin : true };
					$root.user = o;
					$scope.ui.user =  o;
				});
				
			},
			inputs : {}
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
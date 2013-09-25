var Login = portal.controller('LoginCtrl', ['$scope', 'ui',  'Item', '$rootScope', function($scope, $ui, $item, $root) {

	$scope.ui = {
		login : {
			submit : function() {
			
				$item.resolver.user.signin($scope.ui.login.inputs, function(data) {
					if(data.error) {
					} else {
						o = {name : data.Name, mail: data.Mail, signedin : true };
						console.log(o);
						console.log("was o");
						$root.user = o;
						$scope.ui.user =  o;
					}
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
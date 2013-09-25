var Tool = portal.controller('ToolCtrl', ['$scope', 'ui',  'Item', function($scope, $ui, $item) {
	console.log("Hello from tool")
	console.log($item.data)
	$scope.item = $item.data;
	
	//Will change
	if($scope.item.descriptions.description[0]) {
		$scope.item.desc = $scope.item.descriptions.description[0];
	}
	$scope.ui = {
		changeDesc : function(provider) {
			if(typeof provider == "string") {
			} else {
				$scope.item.desc = provider;
			}
		},
		comments : {
			form : {
				submit : function() {
					console.log($scope.ui.comments.form.data);
					$item.resolver.tools.comments.post($scope.item.identifier.id, $scope.ui.comments.form.data, function(data) {
						if(data.Error) {
							$scope.ui.comments.form.error = data.Error;
						} else {
							$scope.ui.comments.form.error = false;
							$scope.ui.comments.get();
							$scope.ui.comments.form.active = false;
						}
					});
				},
				data : {},
				error : false
			},
			get : function() {
				$item.resolver.tools.comments.get($scope.item.identifier.id, function(data) {
					$scope.ui.comments.list = data.comments;
				});
			},
			list : {}
		}
	};
	$scope.ui.comments.get();
	$ui.title("Tool | " + $scope.item.descriptions.title);
	
	//exec
}]);
Tool.resolveTool = {
	itemData: function($route, Item) {
		console.log($route.current.params.toolId);
		this.data = Item.resolver.tools.one($route.current.params.toolId);
		return Item.data;
	},
	delay: function($q, $timeout) {
		var delay = $q.defer();
		$timeout(delay.resolve, 1000);
		return delay.promise;
	}
}
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
		}
	};
	
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
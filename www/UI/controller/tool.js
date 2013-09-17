var Tool = portal.controller('ToolCtrl', ['$scope', 'ui',  'Item', function($scope, $ui, $item) {
	console.log("Hello from tool")
	$scope.item = { 
		raw : $item.data,
		desc : {
			name : "Test"
		}
	};
	
	$scope.ui = { 
	};
	
	$ui.title("Tool | " + $scope.item.desc.name);
}]);
Tool.resolveTool = {
	itemData: function($route, Item) {
		console.log($route.current.params.toolId);
		var result = Item.query($route.current.params.toolId);
		return result;
	},
	delay: function($q, $timeout) {
		var delay = $q.defer();
		$timeout(delay.resolve, 1000);
		return delay.promise;
	}
}
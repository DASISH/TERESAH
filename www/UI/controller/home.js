var Home = portal.controller('HomeCtrl', ['$scope', 'ui',  'Item', function($scope, $ui, $item) {
	console.log("Hello from tool")
	console.log($item.data)
	$scope.results = {
		items: $item.data.response
	}
	console.log($scope.results)
	$scope.ui = {
		parameters : $item.data.parameters,
		pages : {
			current : 1,
			itemPerPage : 20,
			change : function(page) {
				
				opt = {}
				opt.page = page;
				opt.start = page * 20 - 20;
				
				str = [];
				angular.forEach(opt, function(value, key){
					str.push(key+"="+value);
				});
				
				return $item.all.query({options : str.join("&")}, function(u) { $scope.results.items = u.response; return u; });
				}
		}
	};
	
	$ui.title("Home");
	
	//exec
}]);
Home.resolveHome = {
	itemData: function($route, Item) {
		this.data = Item.search({page: 1});
		return this.data;
	},
	delay: function($q, $timeout) {
		var delay = $q.defer();
		$timeout(delay.resolve, 1000);
		return delay.promise;
	}
}
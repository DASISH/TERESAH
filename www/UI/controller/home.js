var Home = portal.controller('HomeCtrl', ['$scope', 'ui',  'Item', function($scope, $ui, $item) {
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
				
				$item.resolver.tools.all({'page': page}, function(data) {
					console.log(data);
					$scope.results.items = data.response;
					$scope.ui.parameters = data.parameters;
				});
			}
		}
	};
	
	$ui.user.signedin();
	
	$ui.title("Home");
	
	//exec
}]);
Home.resolveHome = {
	itemData: function($route, Item) {
		this.data = Item.resolver.tools.all({'page': 1});
		return this.data;
	},
	delay: function($q, $timeout) {
		var delay = $q.defer();
		$timeout(delay.resolve, 1000);
		return delay.promise;
	}
}
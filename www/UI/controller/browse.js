var BrowseCtrl = portal.controller('BrowseCtrl', ['$scope', 'ui', '$route', 'Item', function($scope, $ui, $route, $item) {
	$scope.results = {
		items: $item.data.response,
		facet : $item.data.facet
	}
	$scope.ui = {
		parameters : $item.data.parameters,
		pages : {
			current : 1,
			itemPerPage : 20,
			change : function(page) {
				
				$item.resolver.browse($route.current.params.facet, $route.current.params.facetID, {'page': page}, function(data) {
					console.log(data);
					$scope.results.items = data.response;
					$scope.ui.parameters = data.parameters;
				});
			}
		}
	};
	
	$ui.user.signedin();
	
	$ui.title("Browse by Facet");
	
	//exec
}]);
BrowseCtrl.resolveBrowseCtrl = {
	itemData: function($route, Item) {
		this.data = Item.resolver.browse($route.current.params.facet, $route.current.params.facetID);
		return this.data;
	},
	delay: function($q, $timeout) {
		var delay = $q.defer();
		$timeout(delay.resolve, 1000);
		return delay.promise;
	}
}
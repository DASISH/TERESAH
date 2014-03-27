var FacetCtrl = portal.controller('FacetCtrl', ['$scope', 'ui', '$route', 'Item', function($scope, $ui, $route, $item) {
	$scope.results = {
		items: $item.data.facets,
		facet : $item.data.facet
	}
	$scope.ui = {
		parameters : $item.data.params,
		pages : {
			current : 1,
			itemPerPage : 20,
			change : function(page) {
				
				$item.resolver.browse.facet($route.current.params.facet, {'page': page}, function(data) {
					$scope.results.items = data.facets;
					$scope.ui.parameters = data.params;
				});
			}
		}
	};
	
	console.log($scope.results)
	
	$ui.title("Browse by Facet | " + $item.data.facet.facetLegend);
	
	//exec
}]);
FacetCtrl.resolveFacetCtrl = {
	itemData: function($route, Item) {
		this.data = Item.resolver.browse.facet($route.current.params.facet);
		return this.data;
	},
	delay: function($q, $timeout) {
		var delay = $q.defer();
		$timeout(delay.resolve, 1000);
		return delay.promise;
	}
}
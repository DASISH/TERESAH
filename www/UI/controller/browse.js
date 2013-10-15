var facetListCtrl = portal.controller('facetListCtrl', ['$scope', 'ui', 'Item', function($scope, $ui, $item) {
	$scope.results = {
		items: $item.data
	}
	console.log($scope.results );
	$ui.title("Browse by Facet");
	
	//exec
}]);
facetListCtrl.resolvefacetListCtrl = {
	itemData: function(Item) {
		Item.resolver.facets(false, false);
		return Item.data;
	},
	delay: function($q, $timeout) {
		var delay = $q.defer();
		$timeout(delay.resolve, 1000);
		return delay.promise;
	}
}
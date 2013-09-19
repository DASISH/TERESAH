var Faceted = portal.controller('FacetedCtrl', ['$scope', 'ui',  'Item', 'Restangular', function($scope, $ui, $item, $rest) {
	
	$scope.ui = {
		facets : {
			facets : $item.data,
			search : function(facet) {
				if(facet.option) {
					option = facet.option;
				} else {
					option = {}
				}
				option["request"] = facet.filter;
				
				return $item.fctSearch.query({field : facet.facetParam, options : $item.serialize(option)}, function (u) { 
					 return u.facets;
				});
			},
			submit : function() {
				constructor = {};
				angular.forEach($scope.ui.facets.facets, function(val) {
					if(val.active) {
						constructor[val.facetParam] = {"request" : []};
						
						//Wont work if keyword list is reloaded
						angular.forEach(val.possibilities.facets, function(opt) {
							if(opt.active) {
								constructor[val.facetParam]["request"].push(opt.id);
							}
						});
					}
				});
				console.log(constructor);
				var facetRest = $rest.all('search/faceted');
				constructor = {facets : constructor};
				facetRest.post(constructor).then(function (data) {
					$scope.results = { items : data.response }
					console.log(data);
				}, function errorCallback() {
					alert("Oops error from server :(");
				});
			}
		}
		
	};
	
	$ui.title("Search | Faceted");
	
	//exec
}]);
Faceted.resolveFaceted = {
	itemData: function($route, Item) {
		Item.facets();
		return Item.data;
	},
	delay: function($q, $timeout) {
		var delay = $q.defer();
		$timeout(delay.resolve, 1000);
		return delay.promise;
	}
}
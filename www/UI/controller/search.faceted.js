var Faceted = portal.controller('FacetedCtrl', ['$scope', 'ui',  'Item', 'Restangular', function($scope, $ui, $item, $rest) {
	//$scope.results = { items : data.response }
	
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
			submit : function(constructor) {
				if(!constructor) {
					constructor = { facets : {}};
				} else {
					constructor[facets] = [];
				}
				angular.forEach($scope.ui.facets.used, function(val) {
					if(val.active) {
						constructor.facets[val.facetParam] = {"request" : []};
						
						//Wont work if keyword list is reloaded
						angular.forEach(val.possibilities, function(opt) {
							if(opt.active) {
								constructor.facets[val.facetParam]["request"].push(opt.id);
							}
						});
					}
				});
				
				var facetRest = $rest.all('search/faceted');
				
				
				facetRest.post(constructor).then(function (data) {
					$scope.results = { items : data.response }
					console.log(data);
					$scope.ui.pages.totalItem = data.parameters.total;
				}, function errorCallback() {
					alert("Oops error from server :(");
				});
				
			},
			select : function(facet, keyword) {
				if(!$scope.ui.facets.used[facet.facetParam]) {
					$scope.ui.facets.used[facet.facetParam] = { "facetParam" : facet.facetParam, "facetLegend" : facet.facetLegend, active: true, "possibilities" : {} }
				} 
				if(keyword.active == false) {
					delete $scope.ui.facets.used[facet.facetParam].possibilities[keyword.id];
				} else {
					$scope.ui.facets.used[facet.facetParam].possibilities[keyword.id] = keyword;
				}
			},
			del : function (par, key) {
				delete $scope.ui.facets.used[par].possibilities[key];
			},
			used : {}
		},
		pages : {
			current : 1,
			itemPerPage : 20,
			totalItem : 0,
			total:0,
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
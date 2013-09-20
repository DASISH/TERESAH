var Faceted = portal.controller('FacetedCtrl', ['$scope', 'ui',  'Item', 'Restangular', function($scope, $ui, $item, $rest) {
	$scope.results = false;
	
	$scope.ui = {
		facets : {
			Error : false,
			facets : $item.data,
			search : function(facet) {
				if(facet.option) {
					option = facet.option;
				} else {
					option = {}
				}
				option["request"] = facet.filter;
				
				return $item.resolver.facets(facet.facetParam, option)
			},
			submit : function(constructor) {
				if(!constructor) {
					constructor = { facets : {}};
				} else {
					constructor["facets"] = {};
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
				
				$item.resolver.search.faceted(constructor, function(data) {
					if(data.Error) {
						$scope.ui.facets.error = data.Error;
					} else {
						$scope.ui.facets.error = false;
					}
					if(data.response) {
						$scope.results = { items : data.response }
						$scope.ui.pages.totalItem = data.parameters.total;
					} else {
						$scope.results = false;
					}
					
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
				
				$scope.ui.facets.submit(opt)
				}
		}
	};
	
	$ui.title("Search | Faceted");
	
	//exec
}]);
Faceted.resolveFaceted = {
	itemData: function($route, Item) {
		Item.resolver.facets(false, false, function(data) {
			x = []
			angular.forEach(data, function(val) {
				console.log(val);
				val["option"] = { case_insensitivity : true };
				x.push(val);
			});
			Item.data = x;
		});
		return Item.data;
	},
	delay: function($q, $timeout) {
		var delay = $q.defer();
		$timeout(delay.resolve, 1000);
		return delay.promise;
	}
}
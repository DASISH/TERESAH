var Faceted = portal.controller('FacetedCtrl', ['$scope', 'ui',  'Item', 'Restangular', function($scope, $ui, $item, $rest) {
	$scope.results = false;
	
	$scope.ui = {
		url : {
			val : null, 
			enable : true, 
			reload : function() {
				options = $item.serialize($ui.url.get());
				if(options) {
					if(options != $scope.ui.url.val && $scope.ui.url.enable == true) {
						//
						//We launch research
						$scope.ui.url.enable = false;
						$item.resolver.search.facetedGet(options, function(data) {
							if(data.status == "error") {
								$scope.ui.facets.error = data.message;
							} else {
								$scope.ui.facets.error = false;
							}
							if(data.response) {
								$scope.ui.url.enable = true;
								if(data.response.length == 0) {
									$scope.results = false;
									$scope.ui.facets.error = "No results";
								} else {
									$scope.ui.url.val = data.parameters.url;
									$ui.url.set(data.parameters.url);
									$scope.results = { items : data.response }
									$scope.ui.pages.totalItem = data.parameters.total;
								}
							} else {
								$scope.results = false;
							}
							//Loop to set items following value in data.parameters
							angular.forEach(data.parameters.facets, function(v, k) {
								angular.forEach(v.request, function(v) {
									this[v] = {name : "HELLO FACET", active : true, id : v};
								}, v.request);
								$scope.ui.facets.used[k] = {active : true, possibilities : v.request, facetParam: k};
								if(v.mode) { if(v.mode == "AND") { modeVal = true; } else {  modeVal = false; }} else { modeVal = true; }
								if(v.optional) { if(v.optional == "1") { optionalVal = true; } else {  optionalVal = false; }} else { optionalVal = true; }
								$scope.ui.facets.options[k] = {inclusive : modeVal, optional : optionalVal};
							})
							
							
							$scope.ui.facets.params = {
								orderBy : data.parameters.orderBy,
								order:	data.parameters.order
							}
						});
					}
				}
			}
		},
		facets : {
			error : false,
			facets : $item.data,
			search : function(facet) {
				if(facet.option) {
					option = facet.option;
				} else {
					option = {}
				}
				option["request"] = facet.filter;
				
				return $item.resolver.facets.facet.search(facet.facetParam, option);
			},
			submit : function(constructor) {
				if(!constructor) {
					constructor = { facets : {}};
				} else {
					constructor["facets"] = {};
				}
				angular.extend(constructor, $scope.ui.facets.params);
				angular.forEach($scope.ui.facets.used, function(val) {
					if(val.active) {
						constructor.facets[val.facetParam] = {"request" : []};
						
						//Wont work if keyword list is reloaded
						angular.forEach(val.possibilities, function(opt) {
							if(opt.active) {
								constructor.facets[val.facetParam]["request"].push(opt.id);
							}
						});
						if($scope.ui.facets.options[val.facetParam].optional == true) {
							constructor.facets[val.facetParam].optional = true;
						}
						if($scope.ui.facets.options[val.facetParam].inclusive == false) {
							constructor.facets[val.facetParam].mode = "OR";
						}
					}
				});
				
				$item.resolver.search.faceted(constructor, function(data) {
					if(data.status == "error") {
						$scope.ui.facets.error = data.message;
					} else {
						$scope.ui.facets.error = false;
					}
					if(data.response) {
						if(data.response.length == 0) {
							$scope.results = false;
							$scope.ui.facets.error = "No results";
						} else {
							$scope.ui.url.val = data.parameters.url;
							$ui.url.set(data.parameters.url);
							$scope.results = { items : data.response }
							$scope.ui.pages.totalItem = data.parameters.total;
						}
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
			used : {},
			options : {},
			params : {
				orderBy : "title",
				order:	"ASC"
			}
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
				
				$scope.ui.facets.submit(opt);
				}
		}
	};
	
	$ui.title("Search | Faceted");
	
	//Formating each options Array
	angular.forEach($scope.ui.facets.facets, function(v) {
		$scope.ui.facets.options[v.facetParam] = {optional : false, inclusive: true};
		$scope.ui.facets.used[v.facetParam] = {};
	});

	$scope.ui.url.reload();
	
	//In case of manual change of URL
	$scope.$on('$routeUpdate', function() {
		$scope.ui.url.reload();
	});
}]);
Faceted.resolveFaceted = {
	itemData: function($route, Item) {
		Item.resolver.facets.list(function(data) {
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
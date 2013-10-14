var AddTool = portal.controller('AddToolCtrl', ['$scope', 'ui',  'Item', function($scope, $ui, $item) {
	$scope.results = false;
	
	$scope.ui = {
		form : {
			fields : {
			},
			save : function() {
				postData = $scope.ui.form.fields;
				facets = $scope.ui.facets.group($scope.ui.facets.used);
				postData["facets"] = facets["facets"];
				
				$item.resolver.tools.insert(postData, function(data) {
					console.log(data);
				});
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
				
				return $item.resolver.facets(facet.facetParam, option)
			},
			group : function(constructor) {
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
				return constructor;
			},
			submit : function(constructor) {
				constructor = $scope.ui.facets.group(constructor);
				
				$item.resolver.search.faceted(constructor, function(data) {
					if(data.Error) {
						$scope.ui.facets.error = data.Error;
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
			used : {}
		}
	};
	
	$ui.title("Tool | Add");
	
}]);
AddTool.resolveAddTool = {
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
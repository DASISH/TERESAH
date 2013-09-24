var Top = portal.controller('TopCtrl', ['$scope', "$q", "$location", "$route", "Item", "$rootScope", "ui", function($scope, $q, $location, $route, $item, $root, $ui) {
	$scope.ui = {
		search : {
			typeahead : function(str) {
				var defer = $q.defer();
				$item.resolver.search.normal({request : str, limit : 5, case_insensitivity : true}, function(data) {
					defer.resolve(data.response);
				});
				return defer.promise;
			},
			results : [],
			input : undefined,
			select : function(item) {
				$location.path('/tool/'+item.identifiers.shortname)
			}
		},
		routes : {
			active : true,
			getRoute : function(controller) {
				if(controller == $scope.ui.routes.active) {
					return "active";
				}
			}
		},
		user : {
			data : false,
			signedin : function () { $ui.user.signedin(function(data) {
					$scope.ui.user.data = data;
				}); 
			}
		}
	}
	$scope.ui.user.signedin();
	$scope.$on('$routeChangeStart', function(next, current) { 
		$scope.ui.routes.active = current.controller;
	});
}]);
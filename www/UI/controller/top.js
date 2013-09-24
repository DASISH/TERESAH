var Top = portal.controller('TopCtrl', ['$scope', "$http", "$location", function($scope, $http, $location) {
	$scope.ui = {
		search : {
			typeahead : function(str) {
					return $http({
						url: "http://"+document.domain+":8080/search/general", 
						method: "GET",
						params: {request : str, limit : 5}
					 }).
					then(function(data) {
						return data.data.response;
					});
			},
			input : undefined,
			select : function(item) {
				$location.path('/tool/'+item.identifiers.shortname)
			}
		}
	}
}]);
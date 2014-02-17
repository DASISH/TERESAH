var Search = portal.controller('SearchCtrl', ['$scope', 'ui',  'Item', 'Restangular', '$location', function($scope, $ui, $item, $rest, $location) {
	$scope.results = {items : $item.data.response};
	$scope.ui = {
		params : {
			request : null,
			case_insensitivity : true,
			description : false,
			orderBy : "title",
			order : "ASC",
			limited : false
		},
		pages : {
			current : 1,
			itemPerPage : 20,
			change : function(page) {
				
				opt = {}
				opt.page = page;
				opt.start = page * 20 - 20;
				
				$scope.ui.search(opt.start);
			}
		},
		search : function(start) {
			if(!(start)) { 
				$scope.ui.params.start = 0;
			} else {
				$scope.ui.params.start = start;
			}
			$item.resolver.search.normal($scope.ui.params, function(data) {
				if(data.status == "success") {
					$scope.results = {items : data.response};
					$scope.ui.params = data.parameters;
					$scope.ui.status.status = "success";
				} else {
					$scope.ui.status = data;
                                        $scope.results = '';
                                        $scope.ui.params.total = 0;
				}
			});
		},
		status : {
		}
	};
	
	//Merging default with search part of URL
	
	$ui.title("Search | General");
	
	$scope.ui.params = angular.extend({}, $scope.ui.params, $location.search());
	if($item.data.parameters) {
		$scope.ui.params = $item.data.parameters;
	}
	//In case of manual change of URL
	$scope.$on('$routeUpdate', function() {
		$scope.ui.url.reload();
	});
	//exec
}]);
Search.resolveSearch = {
	itemData: function($location, Item) {
		searchObj = $location.search();
		Item.resolver.search.normal(searchObj);
		return Item.data;
	},
	delay: function($q, $timeout) {
		var delay = $q.defer();
		$timeout(delay.resolve, 1000);
		return delay.promise;
	}
}
var apiFaq = portal.controller('apiFaqCtrl', ['$scope', 'ui', 'Item', function($scope, $ui, $item) {
	$scope.documentation = $item.data.faq;
	
	$scope.ui = {
		toggle : function(rte, methd) {
			console.log(rte + methd);
			this.toggled[rte + methd] = !this.toggled[rte + methd];
		},
		toggled : {},
		documentation : {
			selected : null
		}
	}
}]);
apiFaq.resolveAPIFAQ = {
	itemData: function($route, Item) {
		Item.resolver.faq(function(data) {
			Item.data = data;
		});
		return Item.data;
	},
	delay: function($q, $timeout) {
		var delay = $q.defer();
		$timeout(delay.resolve, 1000);
		return delay.promise;
	}
}
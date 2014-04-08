var Home = portal.controller('HomeCtrl', ['$scope', 'ui',  'Item', function($scope, $ui, $item) {
	
        $scope.cloud = $item.data;
        
	$ui.user.signedin();
	
        $("#cloud").jQCloud($scope.cloud);
        
	$ui.title("Home");
	
	//exec
}]);
Home.resolveHome = {
        itemData: function($route, Item) {
            Item.resolver.cloud(function(data) {
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
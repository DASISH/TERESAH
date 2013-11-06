portal.directive('itemList', function() {
	return {
		restrict: 'C',
		scope: {
			items: '=items'
		},
		templateUrl: './view/directive.tool.list.html'
	};
});
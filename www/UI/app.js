var portal = angular.module('toolRegistry', ['ngResource']);

portal.config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.useXDomain = true;
        delete $httpProvider.defaults.headers.common['X-Requested-With'];
    }
]);

portal.
	config(['$routeProvider', function($routeProvider) {
	$routeProvider.
		when('/tool/:toolId', {templateUrl: '/view/tool.html', controller:"ToolCtrl", reloadOnSearch: false, resolve: Tool.resolveTool}).
		// when('/', {templateUrl: ANGULAR_ROOT + '/view/controller-view/search.html', controller:"BrowseCtrl", reloadOnSearch: false}).
		otherwise({redirectTo: '/'});
}]);

console.log("HELLO");
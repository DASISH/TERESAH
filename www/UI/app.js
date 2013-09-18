var portal = angular.module('toolRegistry', ['ngResource', 'ui.bootstrap']);

portal.config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.useXDomain = true;
        delete $httpProvider.defaults.headers.common['X-Requested-With'];
    }
]);

portal.
	config(['$routeProvider', function($routeProvider) {
	$routeProvider.
		when('/tool/:toolId', {templateUrl: '/view/tool.html', controller:"ToolCtrl", reloadOnSearch: false, resolve: Tool.resolveTool}).
		when('/', {templateUrl: '/view/home.html' , controller:"HomeCtrl", reloadOnSearch: false, resolve: Home.resolveHome}).
		otherwise({redirectTo: '/'});
}]);

console.log("HELLO");
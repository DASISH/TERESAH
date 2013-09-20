var portal = angular.module('toolRegistry', ['ui.bootstrap', 'restangular']);

portal.config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.useXDomain = true;
        delete $httpProvider.defaults.headers.common['X-Requested-With'];
		delete $httpProvider.defaults.headers.common['X-Requested-With'];
    }
]);

portal.
	config(['$routeProvider', function($routeProvider) {
	$routeProvider.
		when('/tool/:toolId', {templateUrl: '/view/tool.html', controller:"ToolCtrl", reloadOnSearch: false, resolve: Tool.resolveTool}).
		when('/login/', {templateUrl: '/view/login.html', controller:"LoginCtrl"}).
		when('/search/faceted', {templateUrl: '/view/faceted.html', controller:"FacetedCtrl", reloadOnSearch: false, resolve: Faceted.resolveFaceted}).
		when('/', {templateUrl: '/view/home.html' , controller:"HomeCtrl", reloadOnSearch: false, resolve: Home.resolveHome}).
		otherwise({redirectTo: '/'});
}]);
portal.config(function(RestangularProvider) {
	RestangularProvider.setBaseUrl("http://"+document.domain+":8080");
});
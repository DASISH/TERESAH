var portal = angular.module('toolRegistry', ['ui.bootstrap', 'restangular', 'ngCookies', 'ngSanitize']);
/*
portal.config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.useXDomain = true;
        delete $httpProvider.defaults.headers.common['X-Requested-With'];
		delete $httpProvider.defaults.headers.common['X-Requested-With'];
    }
]);
*/
portal.
	config(['$routeProvider', function($routeProvider) {
	$routeProvider.
		when('/tool/:toolId', {templateUrl: './view/tool.html', controller:"ToolCtrl", reloadOnSearch: false, resolve: Tool.resolveTool}).
		when('/add', {templateUrl: './view/tool.insert.html', controller:"AddToolCtrl", reloadOnSearch: false, resolve: AddTool.resolveAddTool}).
		when('/login/', {templateUrl: './view/login.html', controller:"LoginCtrl"}).
		when('/about/rdf/', {templateUrl: './view/rdf.html'}).
		when('/about/api/', {templateUrl: './view/apiFaq.html', controller:"apiFaqCtrl", resolve: apiFaq.resolveAPIFAQ}).
		when('/search/faceted', {templateUrl: './view/faceted.html', controller:"FacetedCtrl", reloadOnSearch: false, resolve: Faceted.resolveFaceted}).
		when('/', {templateUrl: './view/home.html' , controller:"HomeCtrl", reloadOnSearch: false, resolve: Home.resolveHome}).
		otherwise({redirectTo: './'});
}]);
portal.config(function(RestangularProvider) {
	RestangularProvider.setBaseUrl("http://"+document.domain+"/API");
});
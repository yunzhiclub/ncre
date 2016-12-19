// 路由配置
angular.
module('educationApp').
config(function($stateProvider, $urlRouterProvider) {
	$urlRouterProvider.otherwise('/login');
	$stateProvider.state('home', {
		url: '/home',
		templateUrl: 'template/home.html',
	}).state('home1', {
		url: '/home1',
		templateUrl: 'template/home1.html',
	}).state('personal', {
		url: '/personal',
		templateUrl: 'template/personal.html',
	}).state('tickets', {
		url: '/tickets',
		templateUrl: 'template/tickets.html',
	}).state('score', {
		url: '/score',
		templateUrl: 'template/score.html',
	}).state('notickets', {
		url: '/notickets',
		templateUrl: 'template/notickets.html',
	}).state('noscore', {
		url: '/noscore',
		templateUrl: 'template/noscore.html',
	}).state('login', {
		url: '/login',
		templateUrl: 'template/login.html',
	});
});

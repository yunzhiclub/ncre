'use strict';

// 路由配置
angular.
module('wechatApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ui.router'
]).
config(function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/login');
    $stateProvider.state('home', {
        url: '/home',
        templateUrl: 'views/home.html',
    }).state('home1', {
        url: '/home1',
        templateUrl: 'views/home1.html',
    }).state('personal', {
        url: '/personal',
        templateUrl: 'views/personal.html',
    }).state('tickets', {
        url: '/tickets',
        templateUrl: 'views/tickets.html',
    }).state('score', {
        url: '/score',
        templateUrl: 'views/score.html',
    }).state('notickets', {
        url: '/notickets',
        templateUrl: 'views/notickets.html',
    }).state('noscore', {
        url: '/noscore',
        templateUrl: 'views/noscore.html',
    }).state('login', {
        url: '/login',
        templateUrl: 'views/login.html',
    });
}).
/*
由于整个应用都会跟路由打交道所以把$state和$stateParams这两个对象放在$rootscope上，
方便其他地方注入和应用。这里的run方法只会在angular运行的时候执行一次
*/
run(function($rootScope, $state, $stateParams) {
  $rootScope.$state = $state;
  $rootScope.$stateParams = $stateParams;
});

'use strict';

// 路由配置
angular.
module('educationApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ui.router'
]).
config(function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/login');
    $stateProvider.state('login', {
        url: '/login',
        templateUrl: 'views/login.html',
        controller:function ($scope, $location) {
            $scope.randomNext = function() {
                var random = Math.floor(Math.random()*2);
                if(random == 1){
                    $location.path('tickets');
                }
                else{
                    $location.path('notickets');
                }
            };
        }
    })
    .state('tickets', {
        url: '/tickets',
        templateUrl: 'views/tickets.html',
    })
    .state('notickets', {
        url: '/notickets',
        templateUrl: 'views/notickets.html',
    })
    // .state('home', {
    //     url: '/home',
    //     templateUrl: 'views/home.html',
    // })
    // .state('home1', {
    //     url: '/home1',
    //     templateUrl: 'views/home1.html',
    // })
    // .state('personal', {
    //     url: '/personal',
    //     templateUrl: 'views/personal.html',
    // })
    // .state('score', {
    //     url: '/score',
    //     templateUrl: 'views/score.html',
    // })
    // .state('noscore', {
    //     url: '/noscore',
    //     templateUrl: 'views/noscore.html',
    // });
}).
/*
由于整个应用都会跟路由打交道所以把$state和$stateParams这两个对象放在$rootscope上，
方便其他地方注入和应用。这里的run方法只会在angular运行的时候执行一次
*/
run(function($rootScope, $state, $stateParams) {
  $rootScope.$state = $state;
  $rootScope.$stateParams = $stateParams;
});

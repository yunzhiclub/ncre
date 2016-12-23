'use strict';

// 路由配置
angular.
module('wechatApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ui.router',
    'angular-loading-bar',
]).
config(['$stateProvider', '$urlRouterProvider', 'cfpLoadingBarProvider', function($stateProvider, $urlRouterProvider, cfpLoadingBarProvider) {
    // 设置LoadingBar HTML Loading模板
    cfpLoadingBarProvider.spinnerTemplate = '<div id="loadingToast" ng-show=""><div class="weui-mask_transparent"></div><div class="weui-toast"><i class="weui-loading weui-icon_toast"></i><p class="weui-toast__content">数据加载中</p></div></div>';
    $urlRouterProvider.otherwise('/login');
    $stateProvider
    .state('login', {
        url: '/login',
        templateUrl: 'views/login.html',
        controller:'LoginCtrl',
    })
    .state('tickets', {
        url: '/tickets',
        templateUrl: 'views/tickets.html',
        controller:'TicketsCtrl',
        reload: true,

    })
    .state('notickets', {
        url: '/notickets',
        templateUrl: 'views/notickets.html',
    });
    // // 重置身份证号码
    // .state('resetcardnum', {
    //     url: '/resetcardnum',
    //     templateUrl: 'views/resetcardnum.html',
    //     controller:'resetcardnum',
    // });
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
}]).
/*
由于整个应用都会跟路由打交道所以把$state和$stateParams这两个对象放在$rootscope上，
方便其他地方注入和应用。这里的run方法只会在angular运行的时候执行一次
*/
run(function($rootScope, $state, $stateParams) {
  $rootScope.$state = $state;
  $rootScope.$stateParams = $stateParams;
});

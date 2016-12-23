// 定义模块
var educationApp = angular.module('educationApp', ['ui.router']);

/*
由于整个应用都会跟路由打交道所以把$state和$stateParams这两个对象放在$rootscope上，
方便其他地方注入和应用。这里的run方法只会在angular运行的时候执行一次
*/
educationApp.run(function($rootScope, $state, $stateParams) {
	$rootScope.$state = $state;
	$rootScope.$stateParams = $stateParams;
});

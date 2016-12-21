'use strict';

/**
 * @ngdoc function
 * @name wechatApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the wechatApp
 */
angular.module('wechatApp')
  .controller('MainCtrl', ['user', function (user) {
        // 判断用户是否登录
        if (!user.isLogin()) {
            user.login();
            return;
        }
  }]);

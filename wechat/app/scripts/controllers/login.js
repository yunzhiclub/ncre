'use strict';

/**
 * @ngdoc function
 * @name wechatApp.controller:LoginCtrl
 * @ 用户登陆（维护个人身份证号码，确切的说应该是个人中心）
 * # LoginCtrl
 * Controller of the wechatApp
 */
angular.module('wechatApp')
    .controller('LoginCtrl', ['$scope', '$location', function($scope, $location) {
        // todo:调用user中的setIdCardNum方法
        var submit = function() {
            $location.path('/tickets');
        };

        // 绑定submit
        $scope.submit = function() {
            submit();
        };
    }]);

'use strict';

/**
 * @ngdoc function
 * @name wechatApp.controller:LoginCtrl
 * @description
 * # LoginCtrl
 * Controller of the wechatApp
 */
angular.module('wechatApp')
    .controller('LoginCtrl', ['$location', '$scope', 'user', function($location, $scope, user) {
        user.getUser().then(function success(user){
            $scope.user = user;
        }, function error (){});
    }]);

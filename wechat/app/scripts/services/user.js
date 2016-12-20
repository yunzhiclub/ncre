'use strict';

/**
 * @ngdoc service
 * @name wechatApp.user
 * @description
 * # user
 * Factory in the wechatApp.
 */
angular.module('wechatApp')
    .factory('user', ['cookies', '$window', '$location', 'config', function(cookies, $window, $location, config) {
        // Service logic
        // ...
        var openid;
        var meaningOfLife = 42;
        var isLogin = function() {
            if (typeof getOpenid() === 'undefined') {
                return false;
            } else {
                return true;
            }
        };

        var login = function() {
            var param = $location.search();
            var callback = $window.location.href;
            if (typeof param.openid === 'undefined') {
                // 跳转认证 
                $window.location.href = config.authoUrl + '?callback=' + encodeURIComponent(callback);
            } else {
                cookies.put('openid', param.openid);
                $window.location.href = $window.location.protocol + '//' + $window.location.host + $window.location.pathname;
            }
            return;
        };

        // 获取用户的openid
        var getOpenid = function() {

            if (typeof openid === 'undefined') {
                openid = cookies.get('openid');
            }
            return openid;
        };


        // Public API here
        return {
            someMethod: function() {
                return meaningOfLife;
            },
            isLogin: function() {
                return isLogin();
            },

            // 登录
            login: function() {
                return login();
            },

            getOpenid: function() {
                return getOpenid();
            }

        };
    }]);

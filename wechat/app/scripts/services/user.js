'use strict';

/**
 * @ngdoc service
 * @name wechatApp.user
 * @description
 * # user
 * Factory in the wechatApp.
 */
angular.module('wechatApp')
    .factory('user', ['cookies', '$window', '$location', 'config', '$http', '$q', function(cookies, $window, $location, config, $http, $q) {
        // Service logic
        // ...
        var self = this;
        self.user = {
            openid: '',
            idCardNum: '',
            isReceiveMessage: false,
        };
        var url = config.apiUrl + 'user/';
        // 用户是否登陆
        var isLogin = function() {
            return false;
            if (typeof getOpenid() === 'undefined') {
                return false;
            } else if (getOpenid() === '') {
                return false;
            } else {
                return true;
            }
        };

        // 用户登陆
        var login = function() {
            var openid;
            // 获取使用get方式传入openid信息
            if (self.user.openid === '') {
                var param = $location.search();
                if (typeof param.openid !== 'undefined') {
                    openid = param.openid;
                }
            } else {
                openid = self.user.openid;
            }   

            var callback = $window.location.href;
            if ((typeof openid === 'undefined') || (openid === '')) {
                // 跳转认证 
                $window.location.href = config.authoUrl + '?callback=' + encodeURIComponent(callback);
            } else {
                cookies.put('openid', openid);
                $location.path($location.path()).search({});
            }
            return;
        };

        // 获取用户的openid
        var getOpenid = function() {
            return cookies.get('openid');
        };

        // 获取用户信息
        var getUser = function() {
            var deferred = $q.defer();
            var promise = deferred.promise;
            if ( self.user.openid === '') {
                var openid = getOpenid();
                $http({
                    method: 'GET',
                    url: url + 'getUserByOpenid?openid=' + openid,
                    data: { openid: getOpenid() }
                }).then(function successCallback(response) {
                    console.log('获取用户信息成功：');
                    console.log(response);
                    if (typeof response.data.errorCode !== 'undefined') {
                        console.log('系统发生错误：' + response.data.error);
                    } else {
                        var user = response.data.data;
                        self.user = {
                            openid: user.Openid,
                            idCardNum: user.IdCardNum,
                            isReceiveMessage: user.IsReceiveMessage,
                        };
                        cookies.put('openid', user.Openid);
                    }
                    deferred.resolve(self.user); //执行成功
                }, function errorCallback(response) {
                    console.log(response);
                    deferred.reject(); //执行失败
                });
            } else {
                deferred.resolve(self.user); //执行成功
            }
            return promise;
        };

        // Public API here
        return {
            // 判断用是否登陆
            isLogin: function() {
                return isLogin();
            },

            // 用户登录
            login: function() {
                return login();
            },

            // 获取OPENID
            getOpenid: function() {
                return getOpenid();
            },

            // 获取用户信息
            getUser: function() {
                return getUser();
            },

            // 初始化
            init: function() {
                getUser();
            },

        };
    }]);

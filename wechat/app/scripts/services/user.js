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

            // 获取使用get方式传入openid信息
            var param = getQueryParams();
            var openid = param.openid;
            if (typeof openid === 'undefined') {
                param = $location.search();
                if (typeof param.openid !== 'undefined') {
                    openid = param.openid;
                }
            }     

            var callback = $window.location.href;
            if ((typeof openid === 'undefined') || (openid === '')) {
                // 跳转认证 
                $window.location.href = config.authoUrl + '?callback=' + encodeURIComponent(callback);
            } else {
                cookies.put('openid', openid);
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

        
        // 通过URL获取GET参数
        function getQueryParams() {
            var qs = document.location.search;
            qs = qs.split('+').join(' ');

            var params = {},
                tokens,
                re = /[?&]?([^=]+)=([^&]*)/g;

            tokens = re.exec(qs);
            while (tokens) {
                params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
                tokens = re.exec(qs);
            }

            return params;
        }

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

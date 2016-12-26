'use strict';

/**
 * @ngdoc service
 * @name wechatApp.tickets
 * @考场编排信息
 * # tickets
 * Factory in the wechatApp.
 */
angular.module('wechatApp')
    .factory('tickets', ['user', '$http', '$q', 'config', function(user, $http, $q, config) {

        /**
         * 获取考场编排信息
         * @return   {array}                 数组中的每个实体为考场编排信息
         * @author 梦云智 http://www.mengyunzhi.com
         * @DateTime 2016-12-23T14:13:20+0800
         */
        var getTickets = function() {
            // 定义promise 解决异步问题
            var deferred = $q.defer();
            var promise = deferred.promise;

            // 进行http请求
            $http({
                method: 'POST',
                url: config.apiUrl + 'Ticket/getTicketsByIds/',
                data: { ids: [1, 2] }
            }).then(function successCallback(response) {
                console.log('获取考场编排信息成功：');
                console.log(response);

                // 有错误码返回
                if (typeof response.data.errorCode !== 'undefined') {
                    console.log('系统发生错误：' + response.data.error);
                    deferred.reject(); //执行失败

                // 无错误码返回
                } else {
                    var tickets = response.data.data;
                    deferred.resolve(tickets);  //执行成功, 装载数据
                }
            
            // 网络发生错误 
            }, function errorCallback(response) {
                console.log('获取考场编排信息失败');
                console.log(response);
                deferred.reject();              // 执行失败
            });

            // 返回promise
            return promise;
        };

        // Public API here
        return {
            // 获取考场编排信息
            getTickets: function(callback) {
                return getTickets().then(function success(tickets) {
                    callback(tickets);
                }, function error(response) {
                  console.log('获取考场编排信息失败');
                  console.log(response);
                });
            },
        };
    }]);

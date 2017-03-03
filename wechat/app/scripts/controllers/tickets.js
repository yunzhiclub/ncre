'use strict';

/**
 * @ngdoc function
 * @name wechatApp.controller:TicketsCtrl
 * @考场编排
 * # TicketsCtrl
 * Controller of the wechatApp
 */
angular.module('wechatApp')
    .controller('TicketsCtrl', ['$scope', 'tickets', function($scope, tickets) {
        $scope.tickets = [];                // 考场编排信息
        $scope.loading = true;              // 是否正在加载数据，数据加载过程中，隐藏考场编排信息
        $scope.ticketsEmpty = false;        // 考场编排信息是否为空。为空则显示 未获取到相关数据 的提示界面
        var idCardNum = $scope.user.idCardNum;
        // 对user进行监视，实时的获取考场编排信息
        $scope.$watch('user', function() {
            reload();
        });

        // 重新加载数据
        var reload = function() {

            // 对类型进行判断，防止在程序初始化时，进行的无必要请求
            if (typeof $scope.user !== 'undefined') {
                tickets.getTickets(function(tickets) {
                    $scope.tickets = tickets;

                    // 判断是否有考场编排信息，以便前面判断是否展示 未获取到数据 界面
                    if (tickets.length > 0) {
                        $scope.ticketsEmpty = false;
                    } else {
                        $scope.ticketsEmpty = true;
                    }

                    // 数据加载完毕
                    $scope.loading = false;
                }, idCardNum);
            }
        };

        // 重新加载数据
        $scope.reload = function() {
            $scope.loading = true;      // 数据加载开始
            reload();                   // 重新加载
        };

    }]);

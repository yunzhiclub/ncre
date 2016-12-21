'use strict';

/**
 * @ngdoc service
 * @name wechatApp.config
 * @description
 * # config
 * Constant in the wechatApp.
 */
angular.module('wechatApp')
  .constant('config', {
    appId:'sfdfdfdsfsdf',
    version:'0.0.1',
    cookies: {
        prefix: 'wechat_',        // cookie 名称前缀
        expire:  0,               // cookie 保存时间
    },
    authoUrl: 'http://127.0.0.1/ncre/public/index.php/wechat/OAuth',         // autho认证文件
  });

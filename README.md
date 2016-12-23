## 项目目录
├── CONTRIBUTING.md
├── LICENSE.txt
├── README.md
├── application     // 系统根文件夹
├── build.php       
├── composer.json   // composer文件
├── composer.lock
├── extend          // 第三方扩展（手动安装）
├── landingpage     // 报名着陆页（用于前台的网站的报务）
├── public          // 
├── runtime
├── think
├── thinkphp
├── vendor          // 第三方扩展。使用composer install自动安装
├── web             // 微信端原型设计
├── wechat          // 微信端使用anguarjs搭建的SPA应用

## 本地API开发
- 登陆微信测试号管理，并关注该测试号
- 查看微信公众号管理的右侧用户列表，随便找到openid
- 设置config.php中的wechat中的appid、secret
- 利用ThinkPHP5.0的MCA原理，测试相应的接口。

## 本地微信SPA
- 查看本机实IP
- 设置config.js中oauthUrl、apiUrl 
- 设置gruntfile.js中的connect -> options -> hostname
- 在wechat目录中，使用npm install进行开发依赖程序的自动安装
- 在wechat目录中，使用bower install进行开发第三方扩展库的自动安装
- 在wechat目录中，使用grunt命令，查看是否存在报错信息
- 在wechat目录中，启用grunt serve 开始http服务
- 启用apache服务
- 在微信开发工具中，访问地址：http://本机IP:9000/!#/

> 访问地址必须有后缀必须以上面完全相同。使用 **http://本机IP:9000/** 等格式将引发错误。
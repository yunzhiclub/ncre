# wechat
本项目[angular]使用yoman生成，相关详情请参考：https://github.com/yeoman/generator-angular
This project is generated with [yo angular generator](https://github.com/yeoman/generator-angular)
version 0.15.1.

## Build & development
使用方法
使用npm install 进行项目的初始化，
此时，系统自动为我们下载开发所有需要node_modules

## 加载bower package
运行bower install
此时，系统将我们自动下载项目运行所需要的bower_components

## grunt 对项目是否满足开发条件进行测试
运行grunt


## 项目阅览
完成初始化后，运行命令 grunt serve 来阅览项目。
此时，grunt将为我们运行一系列自动化操作，比如在app\index.html中自动加载bower中依赖的JS文件。
最后，启动浏览器，并访问本机的9000端口。并自动指向app\index.html
Run `grunt` for building and `grunt serve` for preview.

## Testing

使用grunt test 进行单元测试（单元测试PASS）
Running `grunt test` will run the unit tests with karma.

## build
生成发布文档
使用grunt build 来生成项目的生产文档，此时。grunt将自动为我们创建dist文件夹
进行图片的优化及复制，进行JS代码的合并及压缩、进行angularjs V层文件的注入、
进行css样式表文件的合并及压缩、进行字体文件的选取（只选择那此我们用到的字体文件）等。

此时，我们进行入dist文件夹，运行http-server(如未安装,请参考：https://www.npmjs.com/package/http-server 安装)
如果端口被占用，运行http-server -p 8088（或指定其它端口号）来看压缩合并后的项目效果。

第三方说明文档：
easywechat: https://easywechat.org/zh-cn/docs/
angular-loading-bar: https://github.com/chieffancypants/angular-loading-bar

## 本地开发步骤：
- 查看本机实IP
- 登陆微信测试号管理，并关注该测试号
- 设置config.php中的wechat中的appid、secret
- 设置config.js中oauthUrl、apiUrl
- 设置gruntfile.js中的connect -> options -> hostname
- 在wechat目录中，启用grunt serve
- 开始apache服务
- 在微信开发工具中，访问地址：http://本机IP:9000/!#/

> 访问地址必须有后缀必须以上面完全相同。使用 **http://本机IP:9000/** 等格式将引发错误。



# xzh-curl
:panda_face:针对百度熊掌号新接口请求封装（号主页展现、春笋计划优站扶持）

## 文件说明

`xzhome.php` 为号主页展现接口

`newgood.php` 为春笋计划优站扶持接口

使用前请确保你有对应的资格，没有提交了也没用 😜 

## 使用方式

1、获取对应需要的文件，放到网站的可执行目录中

2、补全对应的参数

`$secret` 自定义验证需要的参数，防止接口泄露所用，注意保密

以下配置信息见：[https://ziyuan.baidu.com/xzh/home/index](https://ziyuan.baidu.com/xzh/home/index)

`$appid` 您的熊掌号唯一识别ID 

`token` 在搜索资源平台申请的推送用的准入密钥 

3、请求方式和传参

请求方式未作限制，`Get`和`Post`都可以

传参的问题说一下，参数顺序无所谓，具体如下：

* 号主页展现接口

```php
Get：xzhome.php?secret=test&url=https://qq52o.me/2530.html

Post：xzhome.php
url = https://qq52o.me/2530.html
secret = test
```

* 春笋计划优站扶持

```php
Get：newgood.php?url[]=https://qq52o.me/2530.html&url[]=https://qq52o.me/2529.html&secret=test

Post：newgood.php
url[] = https://qq52o.me/2530.html
url[] = https://qq52o.me/2529.html
secret = test
```

## 注意

确保网站进行了页面改造，并有如下`JSON-LD`代码

```javascript
 <script type="application/ld+json">
        {
            "@context": "https://ziyuan.baidu.com/contexts/cambrian.jsonld",
            "@id": "https://www.example.com/******",
            "appid": "1583219371373511",
            "title": "页面标题******",
            "images": [
                "https://www.example.com/***/pic1.png",
                "https://www.example.com/***/pic2.png",
                "https://www.example.com/***/pic3.png"
            ], //请在此处添加希望在搜索结果中展示图片的url，可以添加0个、1个或3个url
            "pubDate": "2017-06-15T08:00:01" // 需按照yyyy-mm-ddThh:mm:ss格式编写时间，字母T不能省去
        }
    </script> 
```

## 开源协议

[Apache-2.0](https://github.com/sy-records/xzh-curl/blob/master/LICENSE) 

## 赞赏

若对您有帮助，可以赞助或者点击`star`支持下作者哦，谢谢！

<p align="center">
    <img src="http://wx3.sinaimg.cn/mw690/0060lm7Tly1fsv8nvbc0qj30m80hq425.jpg" width="500px">
</p>

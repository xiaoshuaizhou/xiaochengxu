### 基于 `Laravel5.6` 开发的 `小程序商城` 说明文档
#### 封装验证层 `Validator` 
* 封装验证基类 `BaseValidate` 类，便于以后模块的复用和程序扩展 ； 
【例如】`banner` 的验证类 `BannerValidator` 继承于 `BaseValidate` 基类 ，可以复用基类的方法，便于扩展，详细见代码 `BannerController`；
#### RESTFul API 最佳实践；
可以参考【模仿】一下优秀的API设计：
* [豆瓣开发者API](https://developers.douban.com/wiki/?title=api_v2)
* [GitHub开放着API](https://developer.github.com/v3/)
* [阮一峰RESTFul API 设计](http://www.ruanyifeng.com/blog/2014/05/restful_api)    

**RESTFul API 的合理使用（切勿盲目照搬标准的REST）**
#### 封装异常类


全局异常的处理
* 记录日志
* 统一的异常信息格式化，`message` ， `error_code` 等；尽量不要使用 `500状态码` 


#### 在 `.env` 文件中定义 `IMG_PREFIX=http://本站域名/images/`

***
***
#### 解读一对一 `hasOne` 和 `belongsTo`
* 一对一怎么定义
> 一对一的关系要定义在 `主动调用的调用方`   
例如：本项目中 `theme` 和 `image` 两个模型是一对一关系，实际业务中，我们需要从 `theme`模型去调用 `image` 模型中的图片，
所以定义模型关系需要定义在 `theme` 中: 
```php
theme.php
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topicImage()
    {
        return $this->belongsTo('App\Models\Images', 'topic_img_id', 'id');
    }
```
* `hasOne` 和 `belongsTo` 的区别：
> `hasOne` 和 `belongsTo` 是有主从的或者说不能互换的；
为撒？
>>在设计表结构时，两个有一对一关系的模型中，一个表中会设计外键，而另一表中不会设计外键，需要用 `hasOne` 和 `belognsTo` 来区分    
本项目中 `theme` 表中有 `topic_img_id` 对应 `image` 表中的 `id`; 而 `image` 表中没有定义外键，类似于 `theme_id` 的字段；
从这点来说，这一对一的关系是不能互换，不对等的；   
theme 表     
![theme表](https://upload-images.jianshu.io/upload_images/7303277-b929c9dc91264a85.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
image 表     
![image表](https://upload-images.jianshu.io/upload_images/7303277-f81dcf6320247f75.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

```php
theme.php
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topicImage()
    {
        return $this->belongsTo('App\Models\Images', 'topic_img_id', 'id');
    }
```

* 总结：
1. 一对一关系中，一对一的关系模型定义在 `调用的主动方` 模型中，上述中的 `theme` 模型；
2. 一对一关系中，在有外键的模型中 使用 `belongsTo` ； 没有外键的模型 使用 `hasOne`;


***
#### 微信认证体系（token）       
身份认证流程图：
![微信身份认证体系](https://upload-images.jianshu.io/upload_images/7303277-907866ae015ed581.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
客户端访问接口流程图       
![客户端访问下单接口流程](https://upload-images.jianshu.io/upload_images/7303277-1309d1809d59e8d0.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

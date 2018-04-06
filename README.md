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
#### 自定义 `helper` 函数
1. 在 `app` 目录下新建一个 `Support` 目录【自定义名称】, 然后在该目录下新建 `helpers.php` 文件；
2. 在根目录下 `composer.json` 中的 `autoload` 选项中添加 `files` json对象，对应 `步骤1` 新建的 `helpers.php` 注意命名空间 ，下面示例
```php
"autoload": {
        "files":[
            "app/Support/helpers.php"
        ],
        "classmap": [
            "database/seeds",
            "database/factories"
        ],
        "psr-4": {
            "App\\": "app/"
        }
    },
```
**注意：这里注意遵循 `prs-4` 命名空间规范；**
3. 命令行模式下执行 `composer dump-autoload` 命令，用于重新加载 `composer.json` 文件；

***
##### 缓存的使用 `Redis`:
* 安装： 使用命令安装扩展包 `composer require predis/predis`
**注意**
##### 安装时遇到下面错误 ` Command "optimize" is not defined.`
`debug`:
`Laravel5.6` 文档中：
>先前弃用的optimizeArtisan命令已被删除。随着PHP本身（包括OPcache）的最新改进，该 optimize命令不再提供任何相关的性能优势。因此，您可以php artisan optimize从scripts 您的composer.json文件中删除 。

将 `php artisan optimize` 删除就行了
***
#### 模型嵌套
* 在 `product` 模型中声明一个和 `productImages` 的一对多的关系 而 `productImages` 模型同时又和 `image` 是一对一的关系；
* 如果在 `product` 模型查询中关联  `productImages` 查出 `image` 中的字段，此时就要使用 `模型嵌套` 可以在查询中使用 `with(['productImages.image']);`
示例代码：    
```php
public function getProductDetail($id)
    {
        try{
            $res = new ProductProperty($this->productModel::with(['productImages.image', 'productProperty'])->find($id));
        }catch (\Exception $exception){
            throw new ModelNotFoundException('商品不存在');
        }

        return $res;
    }
```

* 嵌套查询中的排序：
```php
public function getProductDetail($id)
    {
        try{
            $res = new ProductProperty(
                $this->productModel->with([
                    'productImages' => function ($query) {
                        return $query->with(['image'])->orderBy('order', 'asc');
                    }])
                    ->with(['productProperty'])
                    ->find($id)
            );
        }catch (\Exception $exception){
            throw new ModelNotFoundException('商品不存在');
        }

        return $res;
    }
```
***
#### 权限使用 `rbac` 重构
***
使用中间件做权限控制:项目中使用 `scope` 参数来控制访问权限
* 首先生成访问中间件文件，使用命令 `php artisan make:middleware CheckPrimaryScope`
* 编写 `App\Http\Middleware\CheckPrimaryScope.php` 中的 `handle` 方法；
```php
//CheckPrimaryScope.php 获取缓存中的scope值，进行判断用户的访问权限         

 public function handle($request, Closure $next)
    {
        if (TokenRepository::getCurrentTokenVar('scope')){
            if (TokenRepository::getCurrentTokenVar('scope') >= ScopeEnum::USER){
                return $next($request);
            }else{
                throw new ForbiddenException('暂无访问权限');
            }
        }else{
            throw new TokenException('token无效或已过期');
        }
    }
```
* 在 `App\Http\Kernel.php` 文件中注册中间件，在 `$routeMiddleware` 属性中加入自定的中间件文件
```php
protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'primaryScope' => CheckPrimaryScope::class,
    ];
```
* 在需要控制访问权限的控制器中使用 `__construct` 构造函数的 `middleware` 属性中声明就可以使用；
```php
public function __construct()
{
    $this->middleware('primaryScope')->only('createOrUpdate');
}
```
* 这里注意 `only` 和 `except`
> `only` : 设置中间件应该应用的控制器方法;
`except` : 设置中间件应该排除的控制器方法

示例代码中中间件的作用仅对 `createOrUpdate` 方法生效
***
#### 处理订单思路：
>处理订单思路
1. 用户在选择商品后，向api提交包含它所选商品的相关信息。
2. api接受商品信息后，检测订单相关商品的库存量[客户端信息和服务器的信息数据不是实时同步，（选择商品后，订单提交之前 缺货）]。
3. 如果有库存，就把订单信息保存到数据库中等同于下单成功，返回客户端消息，告诉客户端可以进行支付。
4. 客户端接受“可以支付消息”，调用支付接口，进行支付操作。
5. 进行支付，扣款之前再次检测库存量（下单之后允许在一定时间段内进行支付{付款}）。
6. 库存量检测通过服务器调用微信的支付接口进行支付。
7. 小程序根据服务器返回参数拉去支付
【在调用支付和支付成功之间再次检测库存量，可能会在调用之后缺货】，发生的概率很小。可忽略
8. 微信会返回一个支付结果，根据微信的返回结果判断是否支付成功。【异步调用】
9. 如果微信返回支付成功，对库存量进行对应的扣除，如果微信返回支付失败，返回一个支付失败的结果【返回客户端支付成功与否是微信返回的。】
![订单流程图](https://upload-images.jianshu.io/upload_images/7303277-036906b2bfade821.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
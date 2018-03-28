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
```flow                     // 流程
st=>start: 开始|past:> http://www.baidu.com // 开始
e=>end: 结束              // 结束
c1=>condition: 条件1:>http://www.baidu.com[_parent]   // 判断条件
c2=>condition: 条件2      // 判断条件
c3=>condition: 条件3      // 判断条件
io=>inputoutput: 输出     // 输出
//----------------以上为定义参数-------------------------

//----------------以下为连接参数-------------------------
// 开始->判断条件1为no->判断条件2为no->判断条件3为no->输出->结束
st->c1(yes,right)->c2(yes,right)->c3(yes,right)->io->e
c1(no)->e                   // 条件1不满足->结束
c2(no)->e                   // 条件2不满足->结束
c3(no)->e                   // 条件3不满足->结束
```

全局异常的处理
* 记录日志
* 统一的异常信息格式化，`message` ， `error_code` 等；尽量不要使用 `500状态码` 
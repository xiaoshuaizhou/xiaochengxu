### 基于 `Laravel5.6` 开发的 `小程序商城` 说明文档
#### 封装验证层 `Validator` 
* 封装验证基类 `BaseValidate` 类，便于以后模块的复用和程序扩展 ； 
【例如】`banner` 的验证类 `BannerValidator` 继承于 `BaseValidate` 基类 ，可以复用基类的方法，便于扩展，详细见代码 `BannerController`；
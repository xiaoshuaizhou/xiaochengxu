<?php

namespace App\Http\Controllers\V1;

use App\Repositories\OrderReposity;
use App\Repositories\TokenRepository;
use App\Validator\OrderProductsGetValidator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 *  订单接口
 */
class OrderController extends Controller
{
    /**
     * 初始化订单验证
     * @var OrderProductsGetValidator
     */
    public $orderValidator;
    /**
     * @var OrderReposity
     */
    protected $orderReposity;

    /**
     * OrderController constructor.
     * @param OrderProductsGetValidator $orderProductsGetValidator
     * @param OrderReposity $orderReposity
     */
    public function __construct(
        OrderProductsGetValidator $orderProductsGetValidator,
        OrderReposity $orderReposity
)
    {
        $this->middleware('appuser')->only('placeOrder');
        $this->orderValidator = $orderProductsGetValidator;
        $this->orderReposity = $orderReposity;
    }

    /**
     * 下单接口
     * @return array
     * @throws \App\Exceptions\OrderException
     * @throws \App\Exceptions\OrderProducts
     * @throws \App\Exceptions\TokenException
     */
    public function placeOrder()
    {
        $products = request()->input('products');
        $this->orderValidator->checkProducts($products);
        $uid = TokenRepository::getCurrentTokenVar('uid');

        return $this->orderReposity->place($uid, $products);
    }
}

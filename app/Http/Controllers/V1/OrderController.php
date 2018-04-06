<?php

namespace App\Http\Controllers\V1;

use App\Validator\OrderProductsGetValidator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 *  订单接口
 */
class OrderController extends Controller
{
    public $orderValidator;
    /**
     * OrderController constructor.
     */
    public function __construct(OrderProductsGetValidator $orderProductsGetValidator)
    {
        $this->middleware('appuser')->only('placeOrder');
        $this->orderValidator = $orderProductsGetValidator;
    }

    //下单接口
    public function placeOrder()
    {
        $products = request()->input('products');
        $this->orderValidator->checkProducts($products);
    }
}

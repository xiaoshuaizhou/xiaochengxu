<?php

namespace App\Repositories;


use App\Exceptions\OrderException;
use App\Exceptions\UserException;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\UserAddress;

/**
 * Class OrderReposity
 * @package App\Repositories
 */
class OrderReposity
{
    /**
     * ProductModel
     * @var
     */
    protected $productModel;
    /**
     * OrderModel
     * @var Order
     */
    public $orderModel;
    /**
     * 客户端传递的商品信息 ['product_id' => 1, 'count' => 3]
     * @var
     */
    protected $oProducts;
    /**
     * 数据库查询的真实的商品信息
     * @var
     */
    protected $products;
    /**
     * 用户id
     * @var
     */
    protected $uid;

    /**
     * OrderReposity constructor.
     * @param Order $orderModel
     * @param Product $product
     */
    public function __construct(
        Order $orderModel,
        Product $product
    )
    {
        $this->orderModel = $orderModel;
        $this->productModel = $product;
    }

    /**
     * 下单，判断库存; 将客户端提交的商品信息[oProducts]和数据库中的商品[products]对比
     * @param $uid
     * @param $oProducts
     * @return array
     * @throws OrderException
     * @throws UserException
     * @throws \Exception
     */
    public function place($uid, $oProducts)
    {
        $this->oProducts = $oProducts;


        $this->uid = $uid;
        $this->products = $this->getProductByOrder($this->oProducts);
        $status = $this->getOrderStatus();

        if (!$status['pass']) {
            $status['order_id'] = -1;
            return $status;
        }
        //生成快照
        $orderSnap = $this->snapOrder($status);
        //创建订单
        $order = $this->createOrder($orderSnap);
        $order['pass'] = true;

        return $order;
    }

    /**
     * 创建订单信息
     * @param $orderSnap
     * @return array
     * @throws \Exception
     */
    public function createOrder($orderSnap)
    {
        $orderNo = self::makeOrderNo();
        try {
            \DB::beginTransaction();
            $this->orderModel->user_id = $this->uid;
            $this->orderModel->order_no = $orderNo;
            $this->orderModel->status = 1;
            $this->orderModel->prepay_id = 1;
            $this->orderModel->snap_img = $orderSnap['snapImg'];
            $this->orderModel->snap_name = $orderSnap['snapName'];
            $this->orderModel->total_count = $orderSnap['totalCount'];
            $this->orderModel->total_price = $orderSnap['orderPrice'];
            $this->orderModel->snap_address = $orderSnap['snapAddress'];
            $this->orderModel->snap_items = json_encode($orderSnap['pStatus']);

            $this->orderModel->save();

            $orderId = $this->orderModel->id;
            foreach ($this->oProducts as &$oproduct) {
                $oproduct['order_id'] = $orderId;
            }
            $orderProduct = new OrderProduct();
            $orderProduct->insert($this->oProducts);

            \DB::commit();
            return ['order_no' => $orderNo, 'order_id' => $orderId, 'created_at' => $this->orderModel->created_at];
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
    }

    /**
     * 生成订单号,避免订单号重复
     * @return string
     */
    public static function makeOrderNo()
    {
        $yCode = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
        $orderSn =
            $yCode[intval(date('Y') - 2017)]
            . strtoupper(dechex(date('m')))
            . date('d')
            . substr(time(), -5)
            . substr(microtime(), 2, 5)
            . sprintf('%02d', rand(0, 99));
        return $orderSn;
    }

    /**
     * 生成快照[历史订单使用]
     * @param $status
     * @throws UserException
     */
    private function snapOrder($status)
    {
        $snap = [
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatus' => [],
            'snapAddress' => '',
            'snapName' => '',
            'snapImg' => '',
        ];
        $snap['orderPrice'] = $status['orderPrice'];
        $snap['totalCount'] = $status['totalCount'];
        $snap['pStatus'] = $status['pStatusArray'];
        $snap['snapAddress'] = json_encode($this->getUserAddress());
        $snap['snapName'] = $this->products[0]['name'];
        $snap['snapImg'] = $this->products[0]['main_img_url'];

        if (count($this->products) > 1) {
            $snap['snapName'] .= '等';
        }
        return $snap;
    }

    /**
     * 查询用户地址
     * @return array
     * @throws UserException
     */
    protected function getUserAddress()
    {
        $userAddress = UserAddress::where('user_id', $this->uid)->first()->toArray();
        if (empty($userAddress)) {
            throw new UserException('用户地址不存在，下单失败');
        }

        return $userAddress;
    }

    /**
     * 判断订单库存状态 [订单中包含多个 product ，所以要判断每一个 product的库存状态]
     * @return array
     * @throws OrderException
     */
    public function getOrderStatus()
    {
        $status = [
            'pass' => true,
            'orderPrice' => 0, // 订单总价
            'totalCount' => 0, //订单中商品总数量
            'pStatusArray' => [] // 快照 历史订单使用
        ];

        foreach ($this->oProducts as $oProduct) {
            $pStatus = $this->getProductStatus($oProduct['product_id'], $oProduct['count'], $this->products);
            //只要有一个商品库存状态不通过，这个订单状态也不会生效
            $pStatus['haveStock'] == true ? $status['pass'] = true : $status['pass'] = false;
            $status['orderPrice'] += $pStatus['totalPrice'];
            $status['totalCount'] += $pStatus['count'];
            array_push($status['pStatusArray'], $pStatus); //订单快照
        }

        return $status;
    }

    /**
     * 判断订单中每一个商品的状态 [库存]
     * @param $oPId 客户端提交订单中的商品id
     * @param $oCount 客户端提交订单中的商品数量
     * @param $products 数据库中查询出的多个商品
     * @return array
     * @throws OrderException
     */
    public function getProductStatus($oPId, $oCount, $products)
    {
        //初始化历史订单信息
        $pStatus = [
            'id' => null,
            'haveStock' => false, // 是否有库存
            'count' => 0,         // 数量
            'name' => '',         // 商品名称
            'totalPrice' => 0,   // 该商品的总价
        ];
        //初始化 products[二维数组] 的下标[一维数组]，用于循环查找 products 中下标为 $oPId 的一维数组
        $pIndex = -1;
        for ($i = 0; $i < count($products); $i++) {
            if ($oPId == $products[$i]['id']) {
                $pIndex = $i;
            }
        }
        //客户端传递 product_id 可能不存在
        if ($pIndex == -1) {
            throw new OrderException('id为' . $oPId . '的商品不存在，创建订单失败');
        } else {
            $product = $products[$pIndex];

            $pStatus['id'] = $product['id'];
            $pStatus['count'] = $oCount;                // 数量
            $pStatus['name'] = $product['name'];         // 商品名称
            $pStatus['totalPrice'] = $product['price'] * $oCount;   // 该商品的总价
            $pStatus['haveStock'] = $product['stock'] - $oCount >= 0 ? true : false;
        }
        return $pStatus;
    }

    //根据提交的商品,查询真实的商品信息
    public function getProductByOrder($oProducts)
    {
        $oPIds = [];
        foreach ($oProducts as $oProduct) {
            array_push($oPIds, $oProduct['product_id']);
        }
        $products = $this->productModel
            ->whereIn('id', $oPIds)
            ->get(['id', 'price', 'stock', 'name', 'main_img_url'])
            ->toArray();

        return $products;
    }


}
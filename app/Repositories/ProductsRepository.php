<?php

namespace App\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\Banner;
use App\Http\Resources\BannerResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class ProductsRepository
 * @package App\Repositories
 */
class ProductsRepository
{
    /**
     * @var Product
     */
    public $productModel;

    /**
     * ProductsRepository constructor.
     * @param $productModel
     */
    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    /**
     * 最新商品列表
     * @param $count
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getRecent($count)
    {
        $res = ProductResource::collection($this->productModel->limit($count)->orderBy('created_at',' desc')->get());

        if ($res->isEmpty()){
            throw new ModelNotFoundException('商品不存在');
        }

        return $res;
    }
}

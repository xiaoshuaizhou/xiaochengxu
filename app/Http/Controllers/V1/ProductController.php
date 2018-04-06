<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\ProductsRepository;
use App\Validator\ProductValidator;

/**
 * Class ProductController
 * @package App\Http\Controllers\V1
 */
class ProductController extends Controller
{
    /**
     * @var ProductsRepository
     */
    public $productRepository;
    /**
     * @var ProductValidator
     */
    public $productValidator;

    /**
     * ProductController constructor.
     * @param ProductsRepository $productRepository
     * @param ProductValidator $productValidator
     */
    public function __construct(
        ProductsRepository $productRepository ,
        ProductValidator $productValidator
    ){
        $this->productRepository = $productRepository;
        $this->productValidator = $productValidator;
    }

    /**
     * @param int $count
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \App\Exceptions\IDMustBePostException
     */
    public function getRecent($count = 15)
    {
        $count = request()->input('count') ? request()->input('count') : $count;
        $this->productValidator->checkCount($count);

        return $this->productRepository->getRecent($count);
    }

    /**
     * 根据分类id获取所有该分类下的所有商品
     * @throws \App\Exceptions\IDMustBePostException
     */
    public function getAllByCategoryId()
    {
        $id = request()->input('id');
        $this->productValidator->IdMustBePostiveInt($id);

        return $this->productRepository->getAllProductByCategoryId($id);
    }

    /**
     * 根据id获取商品
     * @param $id
     * @return \App\Http\Resources\ProductResource
     * @throws \App\Exceptions\IDMustBePostException
     */
    public function getOne($id)
    {
        $this->productValidator->IdMustBePostiveInt($id);

        return  $this->productRepository->getProductDetail($id);
    }

}

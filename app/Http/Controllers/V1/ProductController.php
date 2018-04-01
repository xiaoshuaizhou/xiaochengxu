<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\ProductsRepository;
use App\Validator\ProductValidator;

class ProductController extends Controller
{
    public $productRepository;
    public $productValidator;

    /**
     * ProductController constructor.
     * @param $productRepository
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
     * @return \Illuminate\Support\Collection
     * @throws \App\Exceptions\IDMustBePostException
     */
    public function getRecent($count = 15)
    {
        $count = request()->input('count') ? request()->input('count') : $count;
        $this->productValidator->checkCount($count);

        return $this->productRepository->getRecent($count);
    }

}

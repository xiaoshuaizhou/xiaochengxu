<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRespository;

class CategoryController extends Controller
{
    public $categoryRepository;

    /**
     * CategoryController constructor.
     * @param $categoryRepository
     */
    public function __construct(CategoryRespository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * 获取所有分类列表
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllCat()
    {
        return $this->categoryRepository->getAllCate();
    }
}

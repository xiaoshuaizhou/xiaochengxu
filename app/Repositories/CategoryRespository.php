<?php

namespace App\Repositories;


use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryRespository
{
    public $categoryModel;

    /**
     * CategoryRespository constructor.
     * @param $categoryModel
     */
    public function __construct(Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllCate()
    {
        $res = CategoryResource::collection($this->categoryModel::with('image')->get());
        if ($res->isEmpty()){
            throw new ModelNotFoundException('分类不存在');
        }

        return $res;
    }
}
<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Http\Resources\BannerResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BannersRepository
{
    /**
     * @var Banner
     */
    public $bannerModel;

    /**
     * BannersRepository constructor.
     * @param $bannerModel
     */
    public function __construct(Banner $bannerModel)
    {
        $this->bannerModel = $bannerModel;
    }

    /**
     * 根据id查询Banner信息
     * @param $id
     * @return BannerResource
     */
    public function getBannerById($id)
    {
        try{
            $res = new BannerResource($this->bannerModel::with(['bannerItems', 'bannerItems.image'])->findOrFail($id));
        }catch (ModelNotFoundException $exception){
            throw new ModelNotFoundException('请求的Banner不存在');
        }

        return $res;
    }
}
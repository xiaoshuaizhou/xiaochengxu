<?php

namespace App\Repositories;

use App\Http\Resources\BannerResource;
use App\Models\Banner;

class BannersRepository
{
    public $bannerModel;

    /**
     * BannersRepository constructor.
     * @param $bannerModel
     */
    public function __construct(Banner $bannerModel)
    {
        $this->bannerModel = $bannerModel;
    }

    public function getBannerById($id)
    {

        $res = new BannerResource($this->bannerModel->find($id));

        return $res;
    }
}
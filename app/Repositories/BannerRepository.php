<?php

namespace App\Repositories;

use App\Models\Banner;

/**
 * Class BannerRepository
 * @package App\Repositories
 */
class BannerRepository
{
    /**
     * @var Banner
     */
    protected $bannerModel;

    /**
     * BannerRepository constructor.
     * @param $bannerModel
     */
    public function __construct(Banner $bannerModel)
    {
        $this->bannerModel = $bannerModel;
    }

    /**
     * @param $id
     */
    public function getBannerByID($id)
    {
        //TODO
    }
}
<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\BannerRepository;
use App\Validator\BannerValidator;

class BannerController extends Controller
{
    private $bannerValidator;
    private $bannerModel;
    /**
     * BannerController constructor.
     */
    public function __construct(
        BannerValidator $bannerValidator,
        BannerRepository $bannerRepository
    ){
        $this->bannerValidator = $bannerValidator;
        $this->bannerModel = $bannerRepository;
    }

    /**
     * 根据id 获取banner
     * @param $id
     */
    public function getBanner($id)
    {
        $res = $this->bannerValidator->IdMustBePostiveInt($id);
        if ($res !== true) return $res;
        $banner = $this->bannerModel->getBannerByID($id);
    }
}

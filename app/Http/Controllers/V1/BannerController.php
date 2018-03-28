<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\BannersRepository;
use App\Validator\BannerValidator;

class BannerController extends Controller
{
    private $bannerValidator;
    private $bannerRepository;
    /**
     * BannerController constructor.
     */
    public function __construct(
        BannerValidator $bannerValidator,
        BannersRepository $bannersRepository
    ){
        $this->bannerValidator = $bannerValidator;
        $this->bannerRepository = $bannersRepository;
    }

    /**
     * 根据id 获取banner
     * @param $id
     * @return \App\Http\Resources\BannerResource|bool
     * @throws \App\Exceptions\IDMustBePostException
     */
    public function getBanner($id)
    {
        $res = $this->bannerValidator->IdMustBePostiveInt($id);
        if ($res !== true) return $res;

        return $this->bannerRepository->getBannerById($id);
    }
}
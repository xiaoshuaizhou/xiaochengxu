<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\BannersRepository;
use App\Validator\BannerValidator;

/**
 * Class BannerController
 * @package App\Http\Controllers\V1
 */
class BannerController extends Controller
{
    /**
     * @var BannerValidator
     */
    private $bannerValidator;
    /**
     * @var BannersRepository
     */
    private $bannerRepository;

    /**
     * BannerController constructor.
     * @param BannerValidator $bannerValidator
     * @param BannersRepository $bannersRepository
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
        $this->bannerValidator->IdMustBePostiveInt($id);

        return $this->bannerRepository->getBannerById($id);
    }
}
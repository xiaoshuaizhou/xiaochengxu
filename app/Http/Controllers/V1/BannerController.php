<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Validator\BannerValidator;

class BannerController extends Controller
{
    private $bannerValidator;
    /**
     * BannerController constructor.
     */
    public function __construct(BannerValidator $bannerValidator)
    {
        $this->bannerValidator = $bannerValidator;
    }

    /**
     * 根据id 获取banner
     * @param $id
     */
    public function getBanner($id)
    {
        $res = $this->bannerValidator->IdMustBePostiveInt($id);
        if ($res !== true) return $res;
    }
}

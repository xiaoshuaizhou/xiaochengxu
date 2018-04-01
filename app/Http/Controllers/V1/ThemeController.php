<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\ThemesRepository;
use App\Validator\ThemeValidator;

class ThemeController extends Controller
{
    public $themeRepository;

    protected $themeValidator;
    /**
     * ThemeController constructor.
     * @param $themeRepository
     */
    public function __construct(
        ThemesRepository $themeRepository,
        ThemeValidator $themeValidator
    ){
        $this->themeRepository = $themeRepository;
        $this->themeValidator = $themeValidator;
    }

    /**
     * 主题列表简要信息
     * $url /theme?ids=id1,id2
     * @throws \App\Exceptions\IDMustBePostException
     */
    public function getSimpleList()
    {
        $ids = request()->only('ids');
        $res = $this->themeValidator->checkIDs($ids['ids']);
        if ($res !== true) return $res;

        return $this->themeRepository->getSimpleList($ids);
    }

    /**
     * @param $id
     * @return \App\Http\Resources\ThemeCollection|bool
     * @throws \App\Exceptions\IDMustBePostException
     */
    public function getComplexOne($id)
    {
        $res = $this->themeValidator->IdMustBePostiveInt($id);
        if ($res !== true) return $res;

        return $this->themeRepository->getComplexOne($id);
    }
}

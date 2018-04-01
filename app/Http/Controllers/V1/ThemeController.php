<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\ThemesRepository;
use App\Validator\ThemeValidator;

/**
 * Class ThemeController
 * @package App\Http\Controllers\V1
 */
class ThemeController extends Controller
{
    /**
     * @var ThemesRepository
     */
    public $themeRepository;

    /**
     * @var ThemeValidator
     */
    protected $themeValidator;

    /**
     * ThemeController constructor.
     * @param ThemesRepository $themeRepository
     * @param ThemeValidator $themeValidator
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
        $this->themeValidator->checkIDs($ids['ids']);

        return $this->themeRepository->getSimpleList($ids);
    }

    /**
     * @param $id
     * @return \App\Http\Resources\ThemeResource
     * @throws \App\Exceptions\IDMustBePostException
     */
    public function getComplexOne($id)
    {
        $this->themeValidator->IdMustBePostiveInt($id);

        return $this->themeRepository->getComplexOne($id);
    }
}

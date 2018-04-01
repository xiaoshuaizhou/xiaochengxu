<?php

namespace App\Http\Controllers\V1;

use App\Repositories\ThemesRepository;
use App\Validator\ThemeValidator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     * $url /theme?ids=id1,id2
     * @throws \App\Exceptions\CheckIdsException
     */
    public function getSimpleList()
    {
        $ids = request()->only('ids');

        $res = $this->themeValidator->checkIDs($ids['ids']);

    }
}

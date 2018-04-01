<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Http\Resources\BannerResource;
use App\Models\Theme;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ThemesRepository
{
    public $themeModel;

    /**
     * ThemesRepository constructor.
     * @param $themeModel
     */
    public function __construct(Theme $themeModel)
    {
        $this->themeModel = $themeModel;
    }

    public function getSimpleList($ids)
    {

    }


}
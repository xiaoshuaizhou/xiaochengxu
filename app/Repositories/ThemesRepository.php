<?php

namespace App\Repositories;

use App\Http\Resources\ThemeCollection;
use App\Http\Resources\ThemeResource;
use App\Models\Banner;
use App\Http\Resources\BannerResource;
use App\Models\Theme;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class ThemesRepository
 * @package App\Repositories
 */
class ThemesRepository
{
    /**
     * @var Theme
     */
    public $themeModel;

    /**
     * ThemesRepository constructor.
     * @param $themeModel
     */
    public function __construct(Theme $themeModel)
    {
        $this->themeModel = $themeModel;
    }

    /**
     * @param $ids
     * @return ThemeCollection
     */
    public function getSimpleList($ids)
    {
        $res = new ThemeCollection($this->themeModel::with(['topicImage', 'headImage'])->whereIn('id', explode(',', $ids['ids']))->get());

        if ($res->isEmpty()) {
            throw new ModelNotFoundException('请求的主题不存在');
        }

        return $res;
    }

    /**
     * @param $id
     * @return ThemeResource
     */
    public function getComplexOne($id)
    {
        try{
            $res = new ThemeResource($this->themeModel::with(['topicImage', 'headImage', 'products'])->where('id', $id)->firstOrFail());
        }catch (ModelNotFoundException $e){
            throw new ModelNotFoundException('请求的主题不存在');
        }

        return $res;
    }


}
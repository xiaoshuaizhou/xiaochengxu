<?php

namespace App\Models;

/**
 * Class Theme
 * @package App\Models
 */
class Theme extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'themes';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topicImage()
    {
        return $this->belongsTo('App\Models\Images', 'topic_img_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function headImage()
    {
        return $this->belongsTo('App\Models\Images', 'head_img_id', 'id');
    }
}

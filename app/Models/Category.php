<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property int $topic_img_id
 * @property string $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Images $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereTopicImgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo('App\Models\Images', 'topic_img_id', 'id');
    }
}

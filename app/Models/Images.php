<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Images
 *
 * @property int $id
 * @property string $url
 * @property int $from
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Images whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Images whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Images whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Images whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Images whereUrl($value)
 * @mixin \Eloquent
 */
class Images extends Model
{
    /**
     * @var string
     */
    protected $table = 'images';

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $banner_id
 * @property string $banner_tag
 * @property string $banner_description
 * @property string $url
 * @property string $order
 */

class BannerPromotion extends Model
{
    protected $table = 'banner_promotion';

    protected $fillable = ['banner_id',
                           'banner_tag',
                           'banner_description',                                               
                           'url',
                           'order'];

    protected $primaryKey = 'banner_id';

}

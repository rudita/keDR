<?php
namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\BannerPromotion;

class BannerPromotionTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'banner_promotion'
    ];

    public function transform(BannerPromotion $bannerPromotion)
    {
        return [
            'banner_id'             => $bannerPromotion->banner_id,
            'banner_tag'            => $bannerPromotion->banner_tag,
            'banner_description'    => $bannerPromotion->banner_description,
            'url'                   => $bannerPromotion->url,
            'order'                 => $bannerPromotion->order
        ];
    }
    
}

 
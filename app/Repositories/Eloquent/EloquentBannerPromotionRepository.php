<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BannerPromotionRepository;
use DB;

class EloquentBannerPromotionRepository extends EloquentBaseRepository implements BannerPromotionRepository
{     
    public function getBannerById($banner_id)
    {
        $query = $this->model->query();
        $query->where('banner_id', '=', $banner_id);
        return $query->first();
    }

}

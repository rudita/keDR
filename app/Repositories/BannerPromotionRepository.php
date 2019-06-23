<?php
namespace App\Repositories;

interface BannerPromotionRepository extends BaseRepository
{
   
    public function getBannerById($id);
   
}
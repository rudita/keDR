<?php
namespace App\Repositories\Cache;

use App\Repositories\BannerPromotionRepository;

class BannerPromotionCacheDecorator extends BaseCacheDecorator implements  BannerPromotionRepository
{

    /**
     * BannerPromotionCacheDecorator constructor.
     * @param BannerPromotionRepository $repository
     */
    public function __construct(BannerPromotionRepository $repository)
    {
        parent::__construct();
        $this->entityName = 'banner_promotion';
        $this->repository = $repository;
    }

    public function getBannerById($banner_id)
    {
        return $this->cache
            ->tags($this->entityName, 'global')
            ->remember("{$this->locale}.{$this->entityName}.getBannerById.{$banner_id}", $this->cacheTime,
                function () use($banner_id){
                    return $this->repository->findByIdiNumber($banner_id);
                }
            );
    }

}
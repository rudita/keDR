<?php
namespace App\Repositories\Cache;

use App\Repositories\OTPRepository;

class OTPCacheDecorator extends BaseCacheDecorator implements  OTPRepository
{

    /**
     * OTPCacheDecorator constructor.
     * @param OTPRepository $repository
     */
    public function __construct(OTPRepository $repository)
    {
        parent::__construct();
        $this->entityName = 'otp_verification';
        $this->repository = $repository;
    }

    public function findByPhoneNumber($phone)
    {
        return $this->cache
            ->tags($this->entityName, 'global')
            ->remember("{$this->locale}.{$this->entityName}.findByPhoneNumber.{$phone}", $this->cacheTime,
                function () use($phone){
                    return $this->repository->findByPhoneNumber($phone);
                }
            );
    }


}
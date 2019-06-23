<?php
namespace App\Repositories\Cache;

use App\Repositories\DoctorAccountRepository;

class DoctorAccountCacheDecorator extends BaseCacheDecorator implements  DoctorAccountRepository
{

    /**
     * DoctorAccountCacheDecorator constructor.
     * @param DoctorAccountRepository $repository
     */
    public function __construct(DoctorAccountRepository $repository)
    {
        parent::__construct();
        $this->entityName = 'doctor_accounts';
        $this->repository = $repository;
    }

    public function findByIdiNumber($idi_number)
    {
        return $this->cache
            ->tags($this->entityName, 'global')
            ->remember("{$this->locale}.{$this->entityName}.findByIdiNumber.{$idi_number}", $this->cacheTime,
                function () use($idi_number){
                    return $this->repository->findByIdiNumber($idi_number);
                }
            );
    }

    public function findByUserId($userid)
    {
        return $this->cache
            ->tags($this->entityName, 'global')
            ->remember("{$this->locale}.{$this->entityName}.findByUserId.{$userid}", $this->cacheTime,
                function () use($userid){
                    return $this->repository->findByUserId($userid);
                }
            );
    }
}
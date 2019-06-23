<?php
namespace App\Repositories\Cache;

use App\Repositories\PatientAccountRepository;

class PatientAccountCacheDecorator extends BaseCacheDecorator implements  PatientAccountRepository
{

    /**
     * DoctorAccountCacheDecorator constructor.
     * @param PatientAccountRepository $repository
     */
    public function __construct(PatientAccountRepository $repository)
    {
        parent::__construct();
        $this->entityName = 'patient_accounts';
        $this->repository = $repository;
    }

    public function findByPatientId($patient_id)
    {
        return $this->cache
            ->tags($this->entityName, 'global')
            ->remember("{$this->locale}.{$this->entityName}.findByPatientId.{$patient_id}", $this->cacheTime,
                function () use($patient_id){
                    return $this->repository->findByPatientId($patient_id);
                }
            );
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
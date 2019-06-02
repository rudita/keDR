<?php
namespace App\Repositories\Cache;

use App\Repositories\DoctorAccountRepository;

class DocctorAccountCacheDecorator extends BaseCacheDecorator implements  DoctorAccountRepository
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

    /**
     * @param $email
     * @param $phone
     */
    public function isUnique($email, $phone)
    {
        return $this->repository->isUnique($email, $phone);
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

    public function findById($id)
    {
        return $this->cache
            ->tags($this->entityName, 'global')
            ->remember("{$this->locale}.{$this->entityName}.findById.{$id}", $this->cacheTime,
                function () use($id){
                    return $this->repository->findById($id);
                }
            );
    }
}
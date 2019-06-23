<?php
namespace App\Repositories\Cache;

use App\Repositories\DoctorScheduleRepository;

class DoctorScheduleCacheDecorator extends BaseCacheDecorator implements  DoctorScheduleRepository
{

    /**
     * DoctorAccountCacheDecorator constructor.
     * @param DoctorScheduleRepository $repository
     */
    public function __construct(DoctorScheduleRepository $repository)
    {
        parent::__construct();
        $this->entityName = 'doctor_schedule';
        $this->repository = $repository;
    }

    
}
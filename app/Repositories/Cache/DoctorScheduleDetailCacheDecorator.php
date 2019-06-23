<?php
namespace App\Repositories\Cache;

use App\Repositories\DoctorScheduleDetailRepository;

class DoctorScheduleDetailCacheDecorator extends BaseCacheDecorator implements  DoctorScheduleDetailRepository
{

    /**
     * DoctorAccountCacheDecorator constructor.
     * @param DoctorScheduleRepository $repository
     */
    public function __construct(DoctorScheduleDetailRepository $repository)
    {
        parent::__construct();
        $this->entityName = 'doctor_schedule_detail';
        $this->repository = $repository;
    }

    
}
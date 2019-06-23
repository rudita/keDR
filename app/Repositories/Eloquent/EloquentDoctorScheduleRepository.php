<?php
namespace App\Repositories\Eloquent;

use App\Repositories\DoctorScheduleRepository;

class EloquentDoctorScheduleRepository extends EloquentBaseRepository implements DoctorScheduleRepository
{	
	public function findByLocation($address)
    {
        return $this
        ->model
        ->Where('address', 'like', "%$address%")
        ->get(['doctor_schedule.*']);               
    }
       
}
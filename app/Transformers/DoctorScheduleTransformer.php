<?php
namespace App\Transformers;

use App\Repositories\DoctorScheduleRepository;
use League\Fractal\TransformerAbstract;
use App\Models\DoctorSchedule;

class DoctorScheduleTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'doctor_schedule'
    ];

    public function transform(DoctorSchedule $doctorSchedule)
    {
        return [
            'doctor_id'     => $doctorSchedule->doctor_id,
            'practice_day'  => $doctorSchedule->practice_day,
            'start_time'    => $doctorSchedule->start_time,
            'end_time'      => $doctorSchedule->end_time,
            'quota'         => $doctorSchedule->quota,
            'hospital_name' => $doctorSchedule->hospital_name,
            'longitude'     => $doctorSchedule->longitude,
            'latitude'      => $doctorSchedule->latitude,
            'address'       => $doctorSchedule->address,
        ];
    }
    
}

 
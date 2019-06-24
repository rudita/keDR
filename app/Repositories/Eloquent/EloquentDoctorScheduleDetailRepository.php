<?php
namespace App\Repositories\Eloquent;

use App\Repositories\DoctorScheduleDetailRepository;

class EloquentDoctorScheduleDetailRepository extends EloquentBaseRepository implements DoctorScheduleDetailRepository
{	

    public function findHistorySchedule($doctor_id, $schedule_id)
    {
        return $this
        ->model
        ->join('doctor_schedule', 'doctor_schedule_detail.schedule_id', '=', 'doctor_schedule.schedule_id')
        ->where('doctor_schedule_detail.schedule_id', '=', $schedule_id)
        ->Where('doctor_schedule.doctor_id', '=', $doctor_id)
        ->Where('doctor_schedule_detail.is_done', '=', "1")
        ->get(['doctor_schedule_detail.*']);
    }

    public function findSchedule($doctor_id, $schedule_id)
    {
        return $this
        ->model
        ->join('doctor_schedule', 'doctor_schedule_detail.schedule_id', '=', 'doctor_schedule.schedule_id')
        ->where('doctor_schedule_detail.schedule_id', '=', $schedule_id)
        ->Where('doctor_schedule.doctor_id', '=', $doctor_id)
        ->Where('doctor_schedule_detail.is_done', '=', "0")
        ->get(['doctor_schedule_detail.*']);
    }

}
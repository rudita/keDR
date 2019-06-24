<?php
namespace App\Repositories;

interface DoctorScheduleDetailRepository extends BaseRepository
{  
    public function findHistorySchedule($doctor_id, $schedule_id);
    
    public function findSchedule($doctor_id, $schedule_id);

    public function findNextQueue($schedule_id);
}
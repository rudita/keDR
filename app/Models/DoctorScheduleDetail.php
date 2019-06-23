<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $schedule_id
 * @property string $doctor_id
 * @property string $practice_day
 * @property string $start_time
 * @property string $end_time
 * @property string $quota
 * @property string $hospital_name
 * @property string $longitude
 * @property string $latitude
 */

class DoctorScheduleDetail extends Model
{
    protected $table = 'doctor_schedule_detail';

    protected $fillable = ['schedule_detail_id',
                           'schedule_id',
                           'practice_date',
                           'Is_done'];

    protected $hidden = ['schedule_id'];

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
                        
    public function DoctorSchedule()
    {
        return $this->belongsTo('App\Models\DoctorSchedule', 'schedule_id');
    }

}

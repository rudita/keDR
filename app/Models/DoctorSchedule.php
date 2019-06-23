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

class DoctorSchedule extends Model
{
    protected $table = 'doctor_schedule';

    protected $fillable = ['schedule_id',
                           'doctor_id',
                           'practice_day',                                               
                           'start_time',
                           'end_time',
                           'quota',
                           'hospital_name',
                           'longitude',
                           'latitude',
                           'address'];

    protected $hidden = ['schedule_id',
                        'user_id'];

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo('App\Models\AclUser', 'user_id');
    }
                        
    public function DoctorAccount()
    {
        return $this->belongsTo('App\Models\DoctorAccount', 'doctor_id');
    }

}

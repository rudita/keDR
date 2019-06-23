<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $history_id
 * @property integer $doctor_id
 * @property string $hospital_name
 * @property string $year
 */

class DoctorHistory extends Model
{
    protected $table = 'doctor_employment_history';

    protected $fillable = ['history_id',
                           'doctor_id',
                           'hospital_name',                                               
                           'year'];

    protected $hidden = ['history_id'];

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

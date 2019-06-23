<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $doctor_id
 * @property string $doctor_name
 * @property string $idi_number
 * @property string $handphone
 * @property string $email
 * @property string $specialist_id
 * @property string $about
 * @property string $photo
 * @property string $activated
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 */

class DoctorEducational extends Model
{
    protected $table = 'doctor_educational_background';

    protected $fillable = ['background_id',
                           'doctor_id',
                           'specialist_id',                                               
                           'university',
                           'year'];

    protected $hidden = ['background_id',
                        'doctor_id',
                        'specialist_id'];

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function DoctorEducational()
    {
        return $this->belongsTo('App\Models\DoctorEducational', 'background_id');
    }
    
    public function DoctorAccount()
    {
        return $this->belongsTo('App\Models\DoctorAccount', 'doctor_id');
    }
    
    public function DoctorSpecialist()
    {
        return $this->belongsTo('App\Models\DoctorSpecialist', 'specialist_id');
    }

}

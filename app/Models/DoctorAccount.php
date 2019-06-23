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

class DoctorAccount extends Model
{
    protected $table = 'doctor_accounts';

    protected $fillable = ['doctor_name',
                           'idi_number',
                           'handphone',                                               
                           'email',
                           'specialist_id',
                           'about',
                           'photo',
                           'activated',
                           'user_id'];

    protected $primaryKey = 'doctor_id';

    protected $hidden = ['doctor_id',
                        'user_id'];

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo('App\Models\AclUser', 'user_id');
    }
                        
    public function DoctorSpecialist()
    {
        return $this->belongsTo('App\Models\DoctorSpecialist', 'specialist_id');
    }

}

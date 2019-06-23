<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $patient_id
 * @property string $patient_name
 * @property string $handphone
 * @property string $email
 * @property string $birth_place
 * @property string $birth_date
 * @property string $gender
 * @property string $photo
 * @property string $Address
 * @property string $activated
 * @property string $user_id
 */

class PatientAccount extends Model
{
    protected $table = 'patient_accounts';

    protected $fillable = ['patient_name',
                           'handphone',                                               
                           'email',
                           'birth_place',
                           'birth_date',
                           'gender',
                           'photo',
                           'Address',
                           'activated',
                           'user_id'];

    protected $primaryKey = 'patient_id';

    protected $hidden = ['patient_id',
                        'user_id'];

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\AclUser', 'user_id');
    }
                        

}

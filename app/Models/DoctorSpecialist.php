<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $specialist_id
 * @property string $specialist_name
 * @property string $description
 * @property string $image
 */

class DoctorSpecialist extends Model
{
    protected $table = 'doctor_specialist_type';

    // protected $fillable = [ 'doctor_name',
    // 'idi_number',
    // 'handphone',                                               
    // 'email',
    // 'specialist_id',
    // 'about',
    // 'photo',
    // 'activated',
    // 'user_id',
    // 'specialist_name',
    // 'description',
    // 'image'];

    protected $fillable = ['specialist_name',
                           'description',
                           'image'];

    protected $hidden = ['specialist_id'];
               

}

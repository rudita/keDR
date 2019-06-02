<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorAccount extends Model
{
    protected $table = 'doctor_accounts';

    protected $fillable = ['doctor_name',
                           'specialist_id',
                           'handphone',                          
                           'idi_number',                          
                           'password',
                           'api_token',
                           'web_token',                          
                           'about',
                           'account_verified'];

    protected $hidden = ['id',
                        'api_token',
                        'created_at',
                        'updated_at',
                        'token_doctor',
                        'remember_token'];

}

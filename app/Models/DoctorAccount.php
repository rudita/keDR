<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class doctor extends Model
{

    protected $table = 'doctor_accounts';

    protected $fillable = ['doctor_name',
                           'handphone',
                           'email',
                           'username',                          
                           'password',
                           'api_token',
                           'web_token',
                           'title_id',
                           'about'];

    protected $hidden = ['id',
                        'api_token',
                        'created_at',
                        'updated_at',
                        'token_doctor',
                        'remember_token'];

}

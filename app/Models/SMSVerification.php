<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMSVerification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'handphone',
                            'code',
                            'status' ];

}

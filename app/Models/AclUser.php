<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Cartalyst\Sentinel\Users\EloquentUser;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property string $salutation
 */
class AclUser extends EloquentUser
{
    /**
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'photo',
        'permissions',
        'salutation'
    ];

    protected $appends = [
        'full_name'
    ];

    protected $hidden = ['password'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function doctorDetail()
    {
        return $this->hasOne('App\Models\CustomerAccount', 'user_id');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}

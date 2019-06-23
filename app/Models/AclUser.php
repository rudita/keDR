<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


/**
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property string $api_token
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 */

class AclUser extends Model implements AuthenticatableContract
{
    
    protected $table = 'acl_users';

    /**
     * @var array
     */
    protected $fillable = [
        'username',
        'password'
    ];

    public function fetchUserByCredentials(Array $credentials)
    {
      $arr_user = $this->conn->find('users', ['username' => $credentials['username']]);
       
      if (! is_null($arr_user)) {
        $this->username = $arr_user['username'];
        $this->password = $arr_user['password'];
      }
   
      return $this;
    }
   
    /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Auth\Authenticatable::getAuthIdentifierName()
     */
    public function getAuthIdentifierName()
    {
      return "username";
    }
    
    /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Auth\Authenticatable::getAuthIdentifier()
     */
    public function getAuthIdentifier()
    {
      return $this->{$this->getAuthIdentifierName()};
    }
   
    /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Auth\Authenticatable::getAuthPassword()
     */
    public function getAuthPassword()
    {
      return $this->password;
    }
   
    /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Auth\Authenticatable::getRememberToken()
     */
    public function getRememberToken()
    {
      if (! empty($this->getRememberTokenName())) {
        return $this->{$this->getRememberTokenName()};
      }
    }
   
    /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Auth\Authenticatable::setRememberToken()
     */
    public function setRememberToken($value)
    {
      if (! empty($this->getRememberTokenName())) {
        $this->{$this->getRememberTokenName()} = $value;
      }
    }
   
    /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Auth\Authenticatable::getRememberTokenName()
     */
    public function getRememberTokenName()
    {
      return $this->rememberTokenName;
    }
   
}

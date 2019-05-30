<?php
namespace App\Repositories\Eloquent;

use App\Repositories\AclUserRepository;

class EloquentAclUserRepository extends EloquentBaseRepository implements AclUserRepository
{
    public function findByEmailOrPhone($email, $phone)
    {
        $query = $this->model;
        return $query->where('email', '=', $email)->orWhere(function($query) use($phone) {
            $query->where('phone', '=', $phone);
        })->first();
    }

    public function attempt($identifier, $password)
    {
        $query = $this->model;
        return $query->where('email', '=', $identifier)->orWhere(function($query) use($identifier) {
            $query->where('phone', '=', $identifier);
        })->first();
    }
}
<?php
namespace App\Repositories\Eloquent;

use App\Repositories\AclUserRepository;

class EloquentAclUserRepository extends EloquentBaseRepository implements AclUserRepository
{
    public function findByUsername($username)
    {
        $query = $this->model;
        return $query->where('username', '=', $username)->first();
    }

    public function attempt($identifier, $password)
    {
        $query = $this->model;
        return $query->where('username', '=', $identifier)->first();
    }
}
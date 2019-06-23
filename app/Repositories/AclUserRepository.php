<?php
namespace App\Repositories;

interface AclUserRepository extends BaseRepository
{
    public function findByUsername($username);

    public function attempt($identifier, $password);
}
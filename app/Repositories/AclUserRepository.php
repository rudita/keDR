<?php
namespace App\Repositories;

interface AclUserRepository extends BaseRepository
{
    public function findByEmailOrPhone($email, $phone);

    public function attempt($identifier, $password);
}
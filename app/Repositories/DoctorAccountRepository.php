<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 
 * Time: 
 */

namespace App\Repositories;

interface DoctorAccountRepository extends BaseRepository
{
    public function isUnique($email, $phone);

    public function findByUserId($userId);
}
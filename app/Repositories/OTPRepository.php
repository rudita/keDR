<?php
/**
 * Created by PhpStorm.
 * User: RBA 
 * Date: 01/06/2019
 */

namespace App\Repositories;

interface OTPRepository extends BaseRepository
{  
    public function findByHandphone($phone);
}
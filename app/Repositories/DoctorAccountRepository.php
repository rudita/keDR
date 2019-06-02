<?php
/**
 * Created by PhpStorm.
 * User: RBA 
 * Date: 01/06/2019
 */

namespace App\Repositories;

interface DoctorAccountRepository extends BaseRepository
{
    public function isUnique($email, $phone);

    public function findByIdiNumber($idinumber);

    public function findById($id);
}
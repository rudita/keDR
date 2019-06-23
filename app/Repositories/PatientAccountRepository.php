<?php
/**
 * Created by PhpStorm.
 * User: RBA 
 * Date: 01/06/2019
 */

namespace App\Repositories;

interface PatientAccountRepository extends BaseRepository
{
    public function findByPatientId($doctorid);

    public function findByPhoneNumber($phone);

    public function findByUserId($userid);
}
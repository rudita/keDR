<?php
namespace App\Repositories;

interface DoctorScheduleRepository extends BaseRepository
{  
    public function findByLocation($address); 
}
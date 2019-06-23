<?php
namespace App\Repositories;

interface DoctorSpecialistRepository extends BaseRepository
{
    public function fetch($filter = null, $sort = null, $perPage = 10, $page = 1);

    public function findById($id);

    public function findByName($name);

    public function findBySpecialistId($id);

    public function findBySpecialistIdAndName($id, $name);

    public function findDetailDoctor ($id);

    public function findDoctorSchedule ($id);
    
}
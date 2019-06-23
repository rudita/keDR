<?php
namespace App\Repositories\Eloquent;

use App\Repositories\DoctorAccountRepository;
use DB;

class EloquentDoctorAccountRepository extends EloquentBaseRepository implements DoctorAccountRepository
{     
    public function findByDoctorId($doctor_id)
    {
        $query = $this->model->query();
        $query->where('doctor_id', '=', $doctor_id);
        return $query->first();
    }

    public function findByIdiNumber($idi_number)
    {
        $query = $this->model->query();
        $query->where('idi_number', '=', $idi_number);
        return $query->first();
    }

    public function findByUserId($userid)
    {
        $query = $this->model->query();
        $query->where('user_id', '=', $userid);
        return $query->first();
    }
}

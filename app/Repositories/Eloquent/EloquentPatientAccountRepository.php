<?php
namespace App\Repositories\Eloquent;

use App\Repositories\PatientAccountRepository;
use DB;

class EloquentPatientAccountRepository extends EloquentBaseRepository implements PatientAccountRepository
{   
    public function findByPatientId($patientid)
    {
        $query = $this->model->query();
        $query->where('patient_id', '=', $patientid);
        return $query->first();
    }

    public function findByPhoneNumber($phone)
    {
        $query = $this->model->query();
        $query->where('Handphone', '=', $phone);
        return $query->first();
    }

    public function findByUserId($userid)
    {
        $query = $this->model->query();
        $query->where('user_id', '=', $userid);
        return $query->first();
    }
}

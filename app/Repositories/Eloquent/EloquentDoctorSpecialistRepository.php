<?php
namespace App\Repositories\Eloquent;

use App\Repositories\DoctorSpecialistRepository;

class EloquentDoctorSpecialistRepository extends EloquentBaseRepository implements DoctorSpecialistRepository
{
    public function findById($id)
    {
        return $this
        ->model
        ->join('doctor_accounts', 'doctor_specialist_type.specialist_id', '=', 'doctor_accounts.specialist_id')
        ->where('doctor_accounts.doctor_id', '=', $id)
        ->get(['doctor_accounts.*']);
    }

    public function findByName($name)
    {
        return $this
        ->model
        ->join('doctor_accounts', 'doctor_specialist_type.specialist_id', '=', 'doctor_accounts.specialist_id')
        ->Where('doctor_accounts.doctor_name', 'like', "%$name%")
        ->get(['doctor_accounts.*']);
    }
    
    public function findBySpecialistId($id)
    {
        return $this
        ->model
        ->join('doctor_accounts', 'doctor_specialist_type.specialist_id', '=', 'doctor_accounts.specialist_id')
        ->where('doctor_specialist_type.specialist_id', '=', $id)
        ->get(['doctor_accounts.*']);
    }

    public function findBySpecialistIdAndName($id, $name)
    {
        return $this
        ->model
        ->join('doctor_accounts', 'doctor_specialist_type.specialist_id', '=', 'doctor_accounts.specialist_id')
        ->where('doctor_specialist_type.specialist_id', '=', $id)
        ->Where('doctor_accounts.doctor_name', 'like', "%$name%")
        ->get(['doctor_accounts.*']);
    }

    public function findDetailDoctor ($id)
    {
        return $this
        ->model
        ->join('doctor_accounts', 'doctor_specialist_type.specialist_id', '=', 'doctor_accounts.specialist_id')
        ->leftjoin('doctor_educational_background', 'doctor_accounts.doctor_id', '=', 'doctor_educational_background.doctor_id')
        ->leftjoin('doctor_employment_history', 'doctor_educational_background.doctor_id', '=', 'doctor_employment_history.doctor_id')
        ->Where('doctor_accounts.doctor_id', '=', $id)
        ->get();
    }

    public function findDoctorSchedule ($id)
    {
        return $this
        ->model
        ->join('doctor_accounts', 'doctor_specialist_type.specialist_id', '=', 'doctor_accounts.specialist_id')
        ->leftjoin('doctor_schedule', 'doctor_accounts.doctor_id', '=', 'doctor_schedule.doctor_id')        
        ->Where('doctor_accounts.doctor_id', '=', $id)
        ->get(['doctor_accounts.*']);
    }
    
}
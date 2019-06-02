<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\DoctorAccountRepository;
use DB;

class EloquentDoctorAccountRepository extends EloquentBaseRepository implements DoctorAccountRepository
{

    public function isUnique($email, $phone)
    {
        $user = User::where('email', '=', $email)->orWhere(function($query) use($phone) {
            $query->where('phone', '=', $phone);
        })->first();
        if ( empty($user) ) {
            return true;
        }
        return !$user->is_customer;
    }
    
    public function findByIdiNumber($idi_number)
    {
        $query = $this->model->query();
        $query->where('idi_number', '=', $idi_number);
        return $query->first();
    }

    public function findById($id)
    {
        $query = $this->model->query();
        $query->where('id', '=', $id);
        return $query->first();
    }
}

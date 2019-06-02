<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\SMSVerificationRepository;
use DB;

class EloquentSMSVerificationRepository extends EloquentBaseRepository implements SMSVerificationRepository
{ 

    public function findByHandphone($Handphone)
    {
        $query = $this->model->query();
        $query->where('Handphone', '=', $Handphone);
        return $query->latest()->first();
    }
}

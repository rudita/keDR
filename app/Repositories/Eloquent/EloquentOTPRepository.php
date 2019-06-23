<?php
namespace App\Repositories\Eloquent;

use App\Repositories\OTPRepository;
use DB;

class EloquentOTPRepository extends EloquentBaseRepository implements OTPRepository
{ 

    public function findByHandphone($Handphone)
    {
        $query = $this->model->query();
        $query->where('Handphone', '=', $Handphone);
        return $query->latest()->first();
    }
}

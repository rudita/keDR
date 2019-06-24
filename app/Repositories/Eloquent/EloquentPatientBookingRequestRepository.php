<?php
namespace App\Repositories\Eloquent;

use App\Repositories\PatientBookingRequestRepository;

class EloquentPatientBookingRequestRepository extends EloquentBaseRepository implements PatientBookingRequestRepository
{
    
    public function findNextQueue($schedule_id)
    {
        $query = $this->model->query();
        $orders = $query
        ->where('schedule_detail_id', '=', $schedule_id)
        ->where('is_paid=1')->get();

        $increment = $orders->count() > 0 ? $orders->count()+1 : 1;

        return $increment;
    }

    public function findByBookingId($Bookig_Request_Id)
    {
        $query = $this->model->query();
        $query
        ->where('Bookig_Request_Id', '=', $Bookig_Request_Id)
        ->where('Is_Paid', '=', "1");
        return $query->first();
    }
    
}
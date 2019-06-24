<?php
namespace App\Repositories;

interface PatientBookingRequestRepository extends BaseRepository
{  
    public function findNextQueue($schedule_detail_id);

    public function findByBookingId($booking_request_id);
}
<?php

namespace App\Http\Controllers\Api;

use App\Models\DoctorSpecialist;
use App\Http\Controllers\Controller;
use App\Repositories\PatientBookingRequestRepository;
use App\Transformers\DoctorSpecialistTransformer;
use Illuminate\Http\Request;


class PatientBookingRequestController extends Controller
{
    /**
     * @var PatientBookingRequestRepository
     */
    protected $patientBookingRequestRepository;

    /**
     * CategoryController constructor.
     * @param PatientBookingRequestRepository $catalogItemCategoryRepository
     */
    public function __construct(PatientBookingRequestRepository $patientBookingRequestRepository)
    {        
        $this->patientBookingRequestRepository = $patientBookingRequestRepository;
    }

    /**
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function BookingRegister(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'patient_id' => 'required',
            'schedule_detail_id' => 'required',
            'rates_id' => 'required',
            'remarks' => 'required',
            'method_id' => 'required',            
        ]);
        if ($validator->fails()) {
            throw new BadRequestHttpException($validator->errors()->first());
        }       

        $schedule = $this->patientBookingRequestRepository->create($input);
        return $this->response()->item($schedule, new DoctorScheduleTransformer());
    }

    
    public function BookingQueue(Request $request)
    {        
        $nextQueue = $this->patientBookingRequestRepository->findNextQueue($request->schedule_detail_id);

        $PatientBooking = $this->patientBookingRequestRepository->findByBookingId($request->Booking_Request_Id);

        $this->PatientBookingRequestRepository->update($PatientBooking, [
            'Queue_number' => $nextQueue
        ]);

        // return $this->response()->item($PatientBooking, new PatientBookingRequestTransformer());

        return response()->json(['data' => [ 'message' => 'Booking Queue berhasil']],200);
    }

    public function SubmitQueue(Request $request)
    {        
      
        $PatientBooking = $this->patientBookingRequestRepository->findByBookingId($request->Booking_Request_Id);

        $this->PatientBookingRequestRepository->update($PatientBooking, [
            'Queue_done' => "1"
        ]);

        return response()->json(['data' => [ 'message' => 'Submit Queue berhasil']],200);
        // return $this->response()->item($PatientBooking, new PatientBookingRequestTransformer());
    }
}

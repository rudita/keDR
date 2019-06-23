<?php

namespace App\Http\Controllers\Api;

use App\Models\DoctorScheduleDetail;
use App\Http\Controllers\Controller;
use App\Repositories\DoctorScheduleRepository;
use App\Transformers\DoctorScheduleTransformer;
use App\Repositories\DoctorAccountRepository;
use App\Transformers\DoctorAccountTransformer;
use App\Repositories\DoctorScheduleDetailRepository;
use App\Transformers\DoctorScheduleDetailTransformer;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class DoctorScheduleDetailController extends Controller
{
   
    /**
     * @var DoctorAccountRepository
     */
    protected $doctorAccountRepository;

    /**
     * @var DoctorScheduleRepository
     */
    protected $doctorScheduleRepository;

    /**
     * @var DoctorScheduleDetailRepository
     */
    protected $doctorScheduleDetailRepository;

    /**
     * CategoryController constructor.
     * @param DoctorAccountRepository $DoctorAccountRepository
     * @param DoctorScheduleRepository $DoctorScheduleRepository
     * @param DoctorScheduleDetailRepository $DoctorScheduleDetailRepository
     */
    public function __construct(DoctorAccountRepository $doctorAccountRepository,
                                DoctorScheduleRepository $doctorScheduleRepository,
                                DoctorScheduleDetailRepository $doctorScheduleDetailRepository)
    {
        $this->doctorAccountRepository = $doctorAccountRepository;
        $this->doctorScheduleRepository = $doctorScheduleRepository;
        $this->doctorScheduleDetailRepository = $doctorScheduleDetailRepository;
    }

    /**
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */   

    public function getHistorySchedule(Request $request)
    {
        $filter = $request->only('doctor_id','schedule_id');                
        $id = trim($filter['doctor_id']); 
        $Scheduleid = trim($filter['schedule_id']); 

        try {
            $schedule = $this->doctorScheduleDetailRepository->findHistorySchedule($id, $Scheduleid);
            return response()->json(['data' => $schedule]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getSchedule(Request $request)
    {
        $filter = $request->only('doctor_id','schedule_id');                
        $id = trim($filter['doctor_id']); 
        $Scheduleid = trim($filter['schedule_id']); 

        try {
            $schedule = $this->doctorScheduleDetailRepository->findSchedule($id, $Scheduleid);
            return response()->json(['data' => $schedule]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}

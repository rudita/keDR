<?php

namespace App\Http\Controllers\Api;

use App\Models\DoctorSchedule;
use App\Http\Controllers\Controller;
use App\Repositories\DoctorScheduleRepository;
use App\Transformers\DoctorScheduleTransformer;
use App\Repositories\DoctorAccountRepository;
use App\Transformers\DoctorAccountTransformer;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Validator;
use DB;
use Auth;
use Illuminate\Validation\Rule;

class DoctorScheduleController extends Controller
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
     * CategoryController constructor.
     * @param DoctorAccountRepository $doctorAccountRepository
     * @param DoctorScheduleRepository $catalogItemCategoryRepository
     */
    public function __construct(DoctorAccountRepository $doctorAccountRepository,
                                DoctorScheduleRepository $doctorScheduleRepository)
    {
        $this->doctorAccountRepository = $doctorAccountRepository;
        $this->doctorScheduleRepository = $doctorScheduleRepository;
    }

    /**
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */   
    public function create(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'doctor_id' => 'required',
            'practice_day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'quota' => 'required',
            'hospital_name' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'address' => 'required'
        ]);
        if ($validator->fails()) {
            throw new BadRequestHttpException($validator->errors()->first());
        }

        $schedule = $this->doctorScheduleRepository->create($input);
        return $this->response()->item($schedule, new DoctorScheduleTransformer());
    }


}

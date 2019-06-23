<?php

namespace App\Http\Controllers\Api;

use App\Models\DoctorSpecialist;
use App\Http\Controllers\Controller;
use App\Repositories\DoctorSpecialistRepository;
use App\Transformers\DoctorSpecialistTransformer;
use Illuminate\Http\Request;


class PatientBookingRequestController extends Controller
{
    /**
     * @var DoctorSpecialistRepository
     */
    protected $doctorSpecialistRepository;

    /**
     * CategoryController constructor.
     * @param DoctorSpecialistRepository $catalogItemCategoryRepository
     */
    public function __construct(DoctorSpecialistRepository $doctorSpecialistRepository)
    {        
        $this->doctorSpecialistRepository = $doctorSpecialistRepository;
    }

    /**
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {      
        $specialist = DoctorSpecialist::query()->get();
        return $this->response()->collection($specialist, new DoctorSpecialistTransformer());      
    }   

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\DoctorSpecialistRepository;
use App\Repositories\DoctorAccountRepository;
use App\Repositories\DoctorScheduleRepository;
use App\Transformers\DoctorAccountTransformer;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Validator;
use DB;
use Auth;
use Illuminate\Validation\Rule;
use App\Models\DoctorAccount;

class GetDoctorController extends Controller
{
   
    /**
     * @var DoctorAccountRepository
     */
    protected $doctorAccountRepository;

    /**
     * @var DoctorSpecialistRepository
     */
    protected $doctorSpecialistRepository;

        /**
     * @var DoctorScheduleRepository
     */
    protected $doctorScheduleRepository;

    /**
     * CategoryController constructor.
     * @param DoctorAccountRepository $doctorAccountRepository
     * @param DoctorSpecialistRepository $catalogItemCategoryRepository
     * @param DoctorScheduleRepository $doctorScheduleRepository
     */
    public function __construct(DoctorAccountRepository $doctorAccountRepository,
                                DoctorSpecialistRepository $doctorSpecialistRepository,
                                DoctorScheduleRepository $doctorScheduleRepository)
    {
        $this->doctorAccountRepository = $doctorAccountRepository;
        $this->doctorSpecialistRepository = $doctorSpecialistRepository;
        $this->doctorScheduleRepository = $doctorScheduleRepository;
    }

    /**
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {      
        $doctor = DoctorAccount::query()->get();
        return $this->response()->collection($doctor, new DoctorAccountTransformer());      
    }

    public function getDoctorById(Request $request)
    {
        $filter = $request->only('doctor_id');                
        $id = trim($filter['doctor_id']); 
        try {
            $doctor = $this->doctorSpecialistRepository->findById($id);
            return response()->json(['data' => $doctor]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
 
    public function getDoctorByName(Request $request)
    {
        $filter = $request->only('doctor_name');                
        $name = trim($filter['doctor_name']); 
        try {
            $doctor = $this->doctorSpecialistRepository->findByName($name);
            return response()->json(['data' => $doctor]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getDoctorBySpecialistId(Request $request)
    {
        $id = $request->only('specialist_id');
        try {
            $doctor = $this->doctorSpecialistRepository->findBySpecialistId($id);
            return response()->json(['data' => $doctor]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
  
    public function getDoctorBySpecialistIdAndName(Request $request)
    {
        $filter = $request->only('specialist_id', 'doctor_name');
        $id = trim($filter['specialist_id']);        
        $name = trim($filter['doctor_name']); 
        try {
            $doctor = $this->doctorSpecialistRepository->findBySpecialistIdAndName($id, $name);
            return response()->json(['data' => $doctor]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getDoctorByLocation(Request $request)
    {
        $filter = $request->only('address');       
        $address = trim($filter['address']); 

        try {
            $doctor = $this->doctorScheduleRepository->findByLocation($address);
            return response()->json(['data' => $doctor]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()); 
        }
        
    }
    
    public function getDetailDoctor(Request $request)
    {
        $filter = $request->only('doctor_id');       
        $address = trim($filter['doctor_id']); 

        try {
            $doctor = $this->doctorSpecialistRepository->findDetailDoctor($address);
            return response()->json(['data' => $doctor]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        
    }

    public function getDoctorSchedule(Request $request)
    {
        $filter = $request->only('doctor_id');       
        $address = trim($filter['doctor_id']); 

        try {
            $doctor = $this->doctorSpecialistRepository->findDoctorSchedule($address);
            return response()->json(['data' => $doctor]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        
    }

}

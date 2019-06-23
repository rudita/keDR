<?php
namespace App\Transformers;

use App\Repositories\DoctorSpecialistRepository;
use League\Fractal\TransformerAbstract;
use App\Models\DoctorSpecialist;
use Carbon\Carbon;
use Activation;

class DoctorSpecialistTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'doctor_specialist_type'
    ];

    public function transform(DoctorSpecialist $doctorSpecialist)
    {
        return [
            'specialist_id'         => $doctorSpecialist->specialist_id,
            'specialist_name'       => $doctorSpecialist->specialist_name,
            'description'           => $doctorSpecialist->description,
            'image'                 => $doctorSpecialist->image
        ];
    }
    
}

 
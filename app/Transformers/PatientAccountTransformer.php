<?php
namespace App\Transformers;

use App\Repositories\PatientAccountRepository;
use League\Fractal\TransformerAbstract;
use App\Models\PatientAccount;
use Carbon\Carbon;
use Activation;

class PatientAccountTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'patient_accounts'
    ];

    public function transform(PatientAccount $patientAccount)
    {       
        return [
            'id'               => $patientAccount->user->id,
            'patient_name'     => $patientAccount->user->patient_name,
            'handphone'        => $patientAccount->user->handphone,
            'email'            => $patientAccount->user->email,
            'birth_place'      => $patientAccount->user->birth_place,
            'birth_date'       => $patientAccount->user->birth_date,
            'gender'           => $patientAccount->user->gender,
            'Address'          => $patientAccount->user->Address
        ];
    }
    
}

 
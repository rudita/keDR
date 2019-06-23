<?php
namespace App\Transformers;

use App\Repositories\DoctorAccountRepository;
use League\Fractal\TransformerAbstract;
use App\Models\DoctorAccount;
use Carbon\Carbon;
use Activation;

class DoctorAccountTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'doctor_accounts'
    ];

    public function transform(DoctorAccount $doctorAccount)
    {
        return [
            'id'                    => $doctorAccount->doctor_id,
            'doctor_name'           => $doctorAccount->doctor_name,
            'idi_number'            => $doctorAccount->idi_number,
            'handphone'             => $doctorAccount->handphone,
            'email'                 => $doctorAccount->email,
            'specialist_id'         => $doctorAccount->specialist_id,
            'about'                 => $doctorAccount->about           
        ];
    }
    
}

 
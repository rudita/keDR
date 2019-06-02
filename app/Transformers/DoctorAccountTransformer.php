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
        // $activation = Activation::completed($doctorAccount->user);

        return [
            'id'                    => $doctorAccount->user->id,
            'doctor_name'           => $doctorAccount->user->doctor_name,
            'specialist_id'         => $doctorAccount->user->specialist_id,
            'handphone'             => $doctorAccount->user->handphone,
            'idi_number'            => $doctorAccount->user->idi_number,
            'password'              => $doctorAccount->user->password
        ];
    }
    
}

 
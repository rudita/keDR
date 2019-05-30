<?php
namespace App\Transformers;

use App\Repositories\DoctorAccountRepository;
use League\Fractal\TransformerAbstract;
use App\Models\DoctorAccount;
use Carbon\Carbon;
use Activation;

class DoctorAccountTransformer extends TransformerAbstract
{
    // protected $availableIncludes = [
    //     'walletLogs',
    //     'creditCards',
    // ];

    // protected $defaultIncludes = [
    //     'groups'
    // ];

    public function transform(DoctorAccount $doctorAccount)
    {
        $activation = Activation::completed($doctorAccount->user);

        return [
            'id'                    => (int) $doctorAccount->id,
            'phone'                 => $doctorAccount->user->phone,
            'email'                 => $doctorAccount->user->email,
            'first_name'            => $doctorAccount->user->first_name,
            'last_name'             => $doctorAccount->user->last_name,
            'full_name'             => $doctorAccount->user->first_name.' '.$doctorAccount->user->last_name,
            'photo'                 => $doctorAccount->user->photo,
            'invite_code'           => $doctorAccount->invite_code,
            'invitation_code'       => $doctorAccount->invitation_code,
            'invitation_uri'        => $doctorAccount->invitation_uri,
            'social_login_type'     => $doctorAccount->social_login_type,
            'social_login_id'       => $doctorAccount->social_login_id,
            'current_credits'       => $doctorAccount->current_credits,
            'newsletter_subscribed' => $doctorAccount->newsletter_subscribed,
            'last_login'            => $doctorAccount->user->last_login,
            'created_at'            => $doctorAccount->created_at->format('d/m/Y H:i:s'),
            'addresses'             => $doctorAccount->addresses,
            'activated'             => (bool) $activation['completed'],
            'salutation'            => $doctorAccount->user->salutation,
            'wallet_balance'        => $doctorAccount->wallet_balance
        ];
    }

    // public function includeWalletLogs(CustomerAccount $data)
    // {
    //     $model = $data->walletLogs;

    //     return $this->collection($model, new CustomerAccountWalletLogTransformer);
    // }

    // public function includeCreditCards(CustomerAccount $data)
    // {
    //     $model = $data->creditCards;

    //     return $this->collection($model, new CustomerAccountCreditCardTransformer);
    // }

    // public function includeGroups(CustomerAccount $customerAccount)
    // {
    //     $groups = $customerAccount->groups;
    //     return $this->collection($groups, new CustomerGroupTransformer);
    // }
}

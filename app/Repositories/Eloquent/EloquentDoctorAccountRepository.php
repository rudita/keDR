<?php
namespace App\Repositories\Eloquent;

use App\Models\AclUser;
use App\Repositories\DoctorAccountRepository;
use DB;

class EloquentDoctorAccountRepository extends EloquentBaseRepository implements DoctorAccountRepository
{

    public function isUnique($email, $phone)
    {
        $user = AclUser::where('email', '=', $email)->orWhere(function($query) use($phone) {
            $query->where('phone', '=', $phone);
        })->first();
        if ( empty($user) ) {
            return true;
        }

        return !$user->is_customer;
    }

    protected function getCustomerByGroupId($id) {
        $query = $this->model->query();

        return $query->select('customer__accounts.*')
            ->join('customer__account_groups', 'customer__account_groups.account_id', '=', 'customer__accounts.id')
            ->where('customer__account_groups.group_id', $id)
            ->groupBy('customer__accounts.id')
            ->get();
    }

    public function fetch($filter = [], $sort = [], $perPage = 10, $page = 1)
    {
        $query = $this->model->query();

        /**
         * @deprecated Please use `where_not_group` instead
         */
        if(array_key_exists('account.not_group_id', $filter)) {
            $filter['where_not_group'] = $filter['account.not_group_id'];
        }

        /**
         * @deprecated Please use `where_group` instead
         */
        if(array_key_exists('account.group_id', $filter)) {
            $filter['where_group'] = $filter['account.group_id'];
        }

        /**
         * @deprecated Please use `name` instead
         */
        if(array_key_exists('full_name', $filter)) {
            $filter['name'] = $filter['full_name'];

        }

        if(array_key_exists('full_name', $sort)) {
            $sort['name'] = $sort['full_name'];
        }

        $query
            ->select('customer__accounts.*')
            ->join('users', 'users.id', '=', 'customer__accounts.user_id')
            ->join('activations', 'users.id', '=', 'activations.user_id')
            ->groupBy('users.id');

        foreach ( $filter as $field => $value ) {
            if(is_null($value)) {
                continue;
            }

            switch ($field) {
                case 'name':
                    $value = str_replace(' ', '|', trim(preg_replace('/\s\s+/', ' ', $value)));

                    $query
                        ->where('users.first_name', 'REGEXP', $value)
                        ->orWhere('users.last_name', 'REGEXP', $value);
                    break;

                case 'email':
                    $query->where('users.email', 'LIKE', "%{$value}%");
                    break;

                case 'activated':
                    $query->where('activations.completed', '=', $value);
                    break;

                case 'where_not_group':
                    $excludedCustomer = $this->getCustomerByGroupId($filter['where_not_group'])->map(function($item) {
                        return $item->id;
                    });

                    $query->whereNotIn('customer__accounts.id', $excludedCustomer);
                    break;

                case 'where_group':
                    $includedCustomer = $this->getCustomerByGroupId($filter['where_group'])->map(function($item) {
                        return $item->id;
                    });

                    $query->whereIn('customer__accounts.id', $includedCustomer);
                    break;
            }
        }

        foreach ($sort as $field => $direction) {
            switch ($field) {
                case 'name':
                    $query->orderBy('users.first_name', $direction);
                    break;
                case 'email':
                    $query->orderBy('users.email', $direction);
                    break;
                case 'phone':
                    $query->orderBy('users.phone', $direction);
                    break;
                case 'created_at':
                    $query->orderBy('customer__accounts.created_at', $direction);
                    break;
            }
        }

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    public function findByUserId($userId)
    {
        $query = $this->model->query();
        $query->where('user_id', '=', $userId);
        return $query->first();
    }
}

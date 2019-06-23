<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $specialist_id
 * @property string $specialist_name
 * @property string $description
 * @property string $image
 */

class PaymentRates extends Model
{
    protected $table = 'payment_rates';

    protected $fillable = ['rates_name',
                           'rates'];

    protected $hidden = ['rates_id'];
               

}

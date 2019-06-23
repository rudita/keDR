<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $specialist_id
 * @property string $specialist_name
 * @property string $description
 * @property string $image
 */

class PaymentMethod extends Model
{
    protected $table = 'payment_method';

    protected $fillable = ['method_name',
                           'remarks'];

    protected $hidden = ['method_id'];
               

}

<?php

use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('payment_method')->insert([
            'method_name' => 'BCA',       
            'remarks' => 'BCA Virtual Account',
        ]);

        DB::table('payment_method')->insert([
            'method_name' => 'OVO',       
            'remarks' => 'OVO Virtual Account',
        ]);

        DB::table('payment_method')->insert([
            'method_name' => 'GooglePlay',       
            'remarks' => 'GooglePlay',
        ]);
    }
}

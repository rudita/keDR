<?php

use Illuminate\Database\Seeder;

class PaymentRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_rates')->insert([
            'rates_name' => 'Booking Doctor',       
            'rates' => 6000,
        ]);        
    }
}

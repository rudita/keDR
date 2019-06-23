<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(DoctorSpecialistTypeSeeder::class);
        // $this->call(PaymentMethodSeeder::class);
        // $this->call(PaymentRatesSeeder::class);
        // $this->call(AclUsersSeeder::class);
        // $this->call(BannerPromotionSeeder::class);
        $this->call(DoctorScheduleSeeder::class);
        
    }
}

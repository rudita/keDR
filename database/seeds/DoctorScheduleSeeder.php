<?php

use Illuminate\Database\Seeder;

class DoctorScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('doctor_schedule')->insert([
            'doctor_id'      => '1',       
            'practice_day'   => 'Senin',
            'start_time'     => '16:00',
            'end_time'       => '18:00',
            'quota'          => '10',
            'hospital_name'  => 'RSKIA PKU MUHAMMADIYAH KOTAGEDE',
            'longitude'      => '110.4028678335221',
            'latitude'       => '-7.820954936238366',
            'address'        => 'JL. KEMASAN NO.43 KOTAGEDE'
        ]);

        DB::table('doctor_schedule')->insert([
            'doctor_id'      => '1',       
            'practice_day'   => 'Senin',
            'start_time'     => '16:00',
            'end_time'       => '18:00',
            'quota'          => '10',
            'hospital_name'  => 'RSIA Permata Bunda',
            'longitude'      => '110.3956909179689',
            'latitude'       => '-7.818908691406193',
            'address'        => 'Jl. Ngeksigondo 56 Yogyakarta'
        ]);
    }
}

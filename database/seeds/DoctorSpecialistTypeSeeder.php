<?php

use Illuminate\Database\Seeder;

class DoctorSpecialistTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctor_specialist_type')->insert([
            'titile_name' => 'Umum',       
            'decription' => 'Dokter Umum',
        ]);
    }
}

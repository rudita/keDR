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
            'specialist_name' => 'Umum',       
            'description' => 'Dokter Umum',
        ]);

        DB::table('doctor_specialist_type')->insert([
            'specialist_name' => 'Anak',       
            'description' => 'Dokter Spesialis Anak',
        ]);

        DB::table('doctor_specialist_type')->insert([
            'specialist_name' => 'Kandungan',       
            'description' => 'Dokter Spesialis Kandungan',
        ]);

        DB::table('doctor_specialist_type')->insert([
            'specialist_name' => 'Penyakit Dalam',       
            'description' => 'Dokter Spesialis Penyakit Dalam',
        ]);

        DB::table('doctor_specialist_type')->insert([
            'specialist_name' => 'Bedah',       
            'description' => 'Dokter Spesialis Bedah',
        ]);

        DB::table('doctor_specialist_type')->insert([
            'specialist_name' => 'Gigi',       
            'description' => 'Dokter Spesialis Gigi',
        ]);

        DB::table('doctor_specialist_type')->insert([
            'specialist_name' => 'Saraf',       
            'description' => 'Dokter Spesialis Saraf',
        ]);

        DB::table('doctor_specialist_type')->insert([
            'specialist_name' => 'THT',       
            'description' => 'Dokter Spesialis THT',
        ]);

        DB::table('doctor_specialist_type')->insert([
            'specialist_name' => 'Mata',       
            'description' => 'Dokter Spesialis Mata',
        ]);

        DB::table('doctor_specialist_type')->insert([
            'specialist_name' => 'Kulit',       
            'description' => 'Dokter Spesialis Kulit',
        ]);
    }
}

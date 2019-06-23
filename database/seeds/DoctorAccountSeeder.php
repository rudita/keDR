<?php

use Illuminate\Database\Seeder;

class DoctorAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('acl_users')->insert([
            'username' => '085888549190',       
            'password' => '123456',
        ]);        
    }
}

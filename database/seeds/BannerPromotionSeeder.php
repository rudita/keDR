<?php

use Illuminate\Database\Seeder;

class BannerPromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('banner_promotion')->insert([
            'banner_tag'            => 'Diskon 25%',       
            'banner_description'    => 'Diskon First Payment',
            'url'                   => 'http://localhost',
            'order'                 => '1',
        ]);

        DB::table('banner_promotion')->insert([
            'banner_tag'            => 'Diskon 75%',       
            'banner_description'    => 'Diskon Oke oke oke punya',
            'url'                   => 'http://localhost',
            'order'                 => '2',
        ]);
    }
}

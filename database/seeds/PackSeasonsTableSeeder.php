<?php

use Illuminate\Database\Seeder;

class PackSeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weight = 0;
        DB::table('pack_seasons')->insert(['name' => 'Summer', 'weight' => $weight+=10]);
        DB::table('pack_seasons')->insert(['name' => 'Winter', 'weight' => $weight+=10]);
        DB::table('pack_seasons')->insert(['name' => 'Spring/Fall', 'weight' => $weight+=10]);
    }
}

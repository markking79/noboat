<?php

use Illuminate\Database\Seeder;

class PackCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weight = 0;
        DB::table('pack_categories')->insert(['name' => 'Pack', 'weight' => $weight+=10, 'is_visible' => true, 'include_in_base_weight' => true, 'include_in_pack_weight' => true]);
        DB::table('pack_categories')->insert(['name' => 'Sleep System', 'weight' => $weight+=10, 'is_visible' => true, 'include_in_base_weight' => true, 'include_in_pack_weight' => true]);
        DB::table('pack_categories')->insert(['name' => 'Cook System', 'weight' => $weight+=10, 'is_visible' => true, 'include_in_base_weight' => true, 'include_in_pack_weight' => true]);
        DB::table('pack_categories')->insert(['name' => 'Water Filtration System', 'weight' => $weight+=10, 'is_visible' => true, 'include_in_base_weight' => true, 'include_in_pack_weight' => true]);
        DB::table('pack_categories')->insert(['name' => 'Electronics', 'weight' => $weight+=10, 'is_visible' => true, 'include_in_base_weight' => true, 'include_in_pack_weight' => true]);
        DB::table('pack_categories')->insert(['name' => 'Hygiene & Medical ', 'weight' => $weight+=10, 'is_visible' => true, 'include_in_base_weight' => true, 'include_in_pack_weight' => true]);
        DB::table('pack_categories')->insert(['name' => 'Town / Extra Clothing', 'weight' => $weight+=10, 'is_visible' => true, 'include_in_base_weight' => true, 'include_in_pack_weight' => true]);
        DB::table('pack_categories')->insert(['name' => 'Misc', 'weight' => $weight+=10, 'is_visible' => true, 'include_in_base_weight' => true, 'include_in_pack_weight' => true]);
        DB::table('pack_categories')->insert(['name' => 'Worn', 'weight' => $weight+=10, 'is_visible' => true, 'include_in_base_weight' => false, 'include_in_pack_weight' => false]);
        DB::table('pack_categories')->insert(['name' => 'Consumable', 'weight' => $weight+=10, 'is_visible' => true, 'include_in_base_weight' => false, 'include_in_pack_weight' => true]);
        DB::table('pack_categories')->insert(['name' => 'Private/Hidden', 'description'=> 'Will never be shown to others.', 'weight' => $weight+=10, 'is_visible' => false, 'include_in_base_weight' => true, 'include_in_pack_weight' => true]);
    }
}

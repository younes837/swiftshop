<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorie')->insert([
            'name' => 'Appliances',
        ]);
        DB::table('categorie')->insert([
            'name' => 'Audio',
        ]);
        DB::table('categorie')->insert([
            'name' => 'Cameras & Camcorders',
        ]);
        DB::table('categorie')->insert([
            'name' => 'Car Electronics & GPS',
        ]);
        DB::table('categorie')->insert([
            'name' => 'Video Games',
        ]);
        DB::table('categorie')->insert([
            'name' => 'TV & Home Theater',
        ]);
        DB::table('categorie')->insert([
            'name' => 'Video Games',
        ]);
        DB::table('categorie')->insert([
            'name' => 'Cell Phones',
        ]);
        DB::table('categorie')->insert([
            'name' => 'Computers & Tablets',
        ]);
        \App\Models\Produit::factory(40)->create();
    }
}

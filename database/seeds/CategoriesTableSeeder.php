<?php

use App\Categories;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categories::create([
            'category' => 'Painting & Drawing',
        ]);

        Categories::create([
            'category' => 'Photography',
        ]);

        Categories::create([
            'category' => 'Prints',
        ]);

        Categories::create([
            'category' => 'Mix Media',
        ]);

        Categories::create([
            'category' => 'Objects',
        ]);
    }
}

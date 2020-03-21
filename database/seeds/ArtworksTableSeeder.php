<?php

use App\Artworks;

use Illuminate\Database\Seeder;

class ArtworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artworks::create([
            'title' => 'Artworks 1',
            'price' => 500,
            'detail' => 'Artworks detail',
            'size' => 50,
            'year' => 2020,
            'category' => 'Model',
        ]);
    }
}

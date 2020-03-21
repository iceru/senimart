<?php

use App\Artists;

use Illuminate\Database\Seeder;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artists::create([
            'name' => 'Shinta Anjani',
            'biography' => 'Shintas Biography',
            'yearbirth' => 1991,
            'hometown' => 'Jakarta',
            'photo' => 'photo.jpg'
        ]);

        Artists::create([
            'name' => 'Kula Anjani',
            'biography' => 'Kula Biography',
            'yearbirth' => 1991,
            'hometown' => 'Jakarta',
            'photo' => 'photo.jpg'
        ]);

        Artists::create([
            'name' => 'Kira Anjani',
            'biography' => 'Kira Biography',
            'yearbirth' => 1991,
            'hometown' => 'Jakarta',
            'photo' => 'photo.jpg'
        ]);
    }
}

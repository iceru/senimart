<?php

use Illuminate\Database\Seeder;
use App\Colors;

class ColorsTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Colors::create([
            'name' => 'black',
        ]);

        Colors::create([
            'name' => 'white',
        ]);

        Colors::create([
            'name' => 'red',
        ]);

        Colors::create([
            'name' => 'green',
        ]);

        Colors::create([
            'name' => 'blue',
        ]);

        Colors::create([
            'name' => 'multicolor',
        ]);
    }
}

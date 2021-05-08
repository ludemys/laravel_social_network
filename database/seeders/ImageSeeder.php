<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $image = new Image();

            $image->user_id = $i + 1;
            $image->path = "test_$i.png";
            $image->description = "test image n°$i";

            $image->save();
        }
    }
}

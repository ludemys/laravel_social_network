<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 23; $i++) {
            $image = new Image();

            $image->user_id = $i + 1;
            $image->path = "test_$i.png";
            $image->description = "test image n°$i";
            $image->date = Carbon::create('2000', '01', '01');
            $image->location = "Caba, Argentina";

            $image->save();
        }
    }
}

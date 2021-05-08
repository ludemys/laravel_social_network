<?php

namespace Database\Seeders;

use App\Models\Like;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $like = new Like();

            $like->user_id = $i + 1;
            $like->image_id = $i + 1;

            $like->save();
        }
    }
}

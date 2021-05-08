<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $comment = new Comment();

            $comment->user_id = $i + 1;
            $comment->image_id = $i + 1;
            $comment->content = "lorem ipsum dolor sit amentfiebfhwfpoiw and more stuff that doesn't matter";

            $comment->save();
        }
    }
}

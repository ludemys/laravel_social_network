<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Request $request, Image $post, $current_page)
    {

        $request->validate([
            'content' => 'required|max:1000'
        ]);

        $comment = new Comment();

        $comment->content = $request->input('content');
        $comment->image_id = $post->id;
        $comment->user_id = session()->get('user')->id;

        $comment->save();

        if ($current_page === 1) {
            return redirect()->route('home.index');
        }

        return redirect()->route('home.index', ['page' => $current_page]);
    }
}

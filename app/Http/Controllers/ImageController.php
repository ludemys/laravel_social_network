<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('Login_auth');
    }

    public function create()
    {
        return view('image.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|file|image|max:5120',
            'description' => 'nullable|max:675',
            'location' => 'nullable|max:100',
            'date' => 'nullable|date'
        ]);

        $image = new Image();

        $image->user_id = session()->get('user')->id ?? 1;

        $image->path = HelperController::store_image('images', $request->file('image'));

        $image->description = $request->input('description') !== null ? $request->input('description') : null;
        $image->location = $request->input('location') !== null ? $request->input('location') : null;
        $image->date = $request->input('date') !== null ? $request->input('date') : null;

        $image->save();

        return redirect()->route('home.index');
    }

    public function like_toggle(Image $post, int $current_page)
    {
        if ($post->has_a_like_from_logged_user()) {
            DB::table('likes')
                ->where('image_id', '=', $post->id)
                ->where('user_id', '=', session()->get('user')->id)
                ->delete();
        } else {
            $like = new Like();

            $like->user_id = session()->get('user')->id;
            $like->image_id = $post->id;

            $like->save();
        }

        if ($current_page === 1) {
            return redirect()->route('home.index');
        }
        return redirect()->route('home.index', ['page' => $current_page]);
    }
}

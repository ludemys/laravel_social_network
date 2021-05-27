<?php

namespace App\Http\Controllers;

use App\Models\Image;
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
}

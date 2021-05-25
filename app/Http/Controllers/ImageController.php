<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'date' => 'nullable|date|date_format:d-m-y'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HelperController extends Controller
{
    public static function store_image($disk, $image)
    {
        if ($image) {
            // Unique name
            $image_path_name = time() . $image->getClientOriginalName();

            // Storage in storage/app/users
            Storage::disk($disk)->put($image_path_name, File::get($image));
        }

        return $image_path_name;
    }

    public function get_image($filename = null, $disk = 'users')
    {
        if ($filename == null) return null;

        $file = Storage::disk($disk)->get($filename);

        return new Response($file, 200);
    }
}

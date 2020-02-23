<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    /**
     * Store image in a database.
     * 
     * @param $request Request
     * @return response
     */
    public function store(Request $request) 
    {
        $attributes = $request->validate([
            'owner_id' => 'required',
            'owner_type' => 'required',
            'image' => 'required|image|max:1024'
        ]);

        $className = 'App\\'.ucfirst($attributes['owner_type']);

        $image = Image::create([
            'owner_id' => $attributes['owner_id'],
            'owner_type' => $className,
            'url' => env('AWS_URL').'/'.request()->file('image')->store('images', 's3')
        ]);
            
        return response()->json($image, 200);
    }

    /**
     * Remove a file from aws s3 and a record from database.
     * 
     * @return response
     */
    public function destroy(Image $image) 
    {
        Storage::disk('s3')->delete($image->url);
        $image->delete();
    }
}

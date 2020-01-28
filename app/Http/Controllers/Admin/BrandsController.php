<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Resources\Brand as BrandCollection;
use App\Http\Resources\BrandCollection as ResourcesBrandCollection;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Return all available brands.
     * 
     * @return JSON
     */
    public function index() 
    {
        return new ResourcesBrandCollection(Brand::all());

        //return BrandCollection::collection(Brand::all());
    }

    public function store(Request $request) 
    {
        $attributes = $this->validate($request, [
            'name' => 'required'
        ]);

        Brand::create($attributes);

        return response()->json('Oh yeah!', 200);
    }
}

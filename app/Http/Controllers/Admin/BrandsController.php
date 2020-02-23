<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Filters\BrandFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Brand as BrandResource;
use App\Http\Resources\BrandCollection as BrandResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BrandsController extends Controller
{

    /**
     * Return all available brands.
     * 
     * @return JSON
     */
    public function index(BrandFilters $filters) 
    {    
        return new BrandResourceCollection(
            Brand::filter($filters)->paginate()
        );
    }

    /**
     * Show an invidual brand.
     * 
     * @return JSON
     */
    public function show(Brand $brand) 
    {
        return new BrandResource($brand);
    }

    /**
     * Store in database.
     * 
     * @return JSON
     */
    public function store(Request $request) 
    {
        Validator::make($request->all(), [
            'name' => [
                'required',
                'unique:brands'
            ]
        ])->validate();

        Brand::create($request->all());

        return response()->json('Oh yeah!', 200);
    }

    public function update(Brand $brand, Request $request) 
    {
        Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('brands')->ignore($brand->id)
            ]
        ])->validate();

        $brand->update($request->all());

        return response()->json('Oh yeah!', 200);
    }

    public function destroy(Brand $brand) 
    {
        return response()->json($brand->delete(), 200);
    }
}

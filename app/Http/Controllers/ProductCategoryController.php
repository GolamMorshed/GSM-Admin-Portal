<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$product_categories = ProductCategory::join('floors','floors.id', '=', 'product_categories.floor')->get(['product_categories.*','floors.floor_name']);
        $product_categories = ProductCategory::join('floors','floors.id', '=',
        'product_categories.floor')
        ->get([
            'product_categories.id',
            'product_categories.image',
            'floors.floor_name',
            'product_categories.category',
            'product_categories.category',
            'product_categories.activation',
            'product_categories.created_at',
            'product_categories.updated_at'
        ]);
        return ProductCategoryResource::collection($product_categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_category = new ProductCategory();
        $product_category->image = $request->file('image')->store('product_category_images');
        $product_category->category = $request->category;
        $product_category->floor = $request->floor;
        $product_category->activation = $request->activation;

        if($product_category->save()){
            return new ProductCategoryResource($product_category);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product_category = ProductCategory::join('floors','floors.id', '=','product_categories.floor')
        ->get([
            'product_categories.id',
            'product_categories.image',
            'floors.floor_name',
            'product_categories.category',
            'product_categories.category',
            'product_categories.activation',
            'product_categories.created_at',
            'product_categories.updated_at'
        ])->where("id",$id);

        return new ProductCategoryResource($product_category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product_category = ProductCategory::findOrFail($id);
        $product_category->category = $request->category;
        $product_category->floor = $request->floor;
        $product_category->activation = $request->activation;

        if($product_category->save()){
            return new ProductCategoryResource($product_category);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

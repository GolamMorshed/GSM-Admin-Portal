<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::join('product_categories','product_categories.id','=','products.category')->get(['products.id','products.image',
        'products.product_name',
        'product_categories.category',
        'products.activation',
        'products.created_at',
        'products.updated_at']);

        return new ProductResource($products);

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
        $product = new Product();
        $product->image = $request->file('image')->store('product_images');
        $product->product_name = $request->product_name;
        $product->category = $request->category;
        $product->activation = $request->activation;

        if($product->save()){
            return new ProductResource($product);
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
        $product = Product::join('product_categories','product_categories.id','=','products.category')
        ->get([
            'products.id','products.image',
            'products.product_name',
            'product_categories.category',
            'products.activation',
            'products.created_at',
            'products.updated_at'
        ])->where("id",$id);

        return new ProductResource($product);
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
        $product = Product::findOrFail($id);
        $product->product_name = $request->product_name;
        $product->category = $request->category;
        $product->activation = $request->activation;

        if($product->save()){
            return new ProductResource($product);
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$brand = Brand::paginate(10);
        $brands = Brand::join('product_categories','product_categories.id','=','brands.category')
        ->join('products','products.id','=','brands.product')
        ->join('merchants','merchants.id','=','brands.merchant')
        ->join('new_shops','new_shops.id','=','brands.shop')
        ->get([
            'brands.id',
            'brands.image',
            'product_categories.category',
            'products.product_name',
            'merchants.merchant_name',
            'new_shops.shop_name',
            'brands.activation',
            'brands.created_at',
            'brands.updated_at'
        ]);

        return BrandResource::collection($brands);
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
        $brand = new Brand();
        $brand->image = $request->file('image')->store('brand_images');
        $brand->category = $request->category;
        $brand->product = $request->product;
        $brand->brand = $request->brand;
        $brand->merchant = $request->merchant;
        $brand->shop = $request->shop;
        $brand->activation = $request->activation;

        if($brand->save()){
            return new BrandResource($brand);
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
        $brand = Brand::join('product_categories','product_categories.id','=','brands.category')
        ->join('products','products.id','=','brands.product')
        ->join('merchants','merchants.id','=','brands.merchant')
        ->join('new_shops','new_shops.id','=','brands.shop')
        ->get([
            'brands.id',
            'brands.image',
            'product_categories.category',
            'products.product_name',
            'merchants.merchant_name',
            'new_shops.shop_name',
            'brands.activation',
            'brands.created_at',
            'brands.updated_at'
        ])->where("id",$id);
        return new BrandResource($brand);
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
        $brand = Brand::findOrFail($id);
        $brand->category = $request->category;
        $brand->product = $request->product;
        $brand->brand = $request->brand;
        $brand->merchant = $request->merchant;
        $brand->shop = $request->shop;
        $brand->activation = $request->activation;

        if($brand->save()){
            return new BrandResource($brand);
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

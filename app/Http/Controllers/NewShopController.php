<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewShop;
use App\Http\Resources\NewShopResource;


class NewShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $new_shops = NewShop::join('merchants','merchants.id','=','new_shops.merchant')
        ->join('brands','brands.id','=','new_shops.brand')
        ->join('product_categories','product_categories.id','=','new_shops.category')
        ->join('floors','floors.id','=','new_shops.floor')
        ->join('malls','malls.id','=','new_shops.mall')
        ->get([
            'new_shops.id',
            'new_shops.image',
            'new_shops.shop_name',
            'merchants.merchant_name',
            'brands.brand',
            'product_categories.category',
            'floors.floor_name',
            'malls.mall_name',
            'new_shops.city',
            'new_shops.selling_identity',
            'new_shops.free_shipping_min_amount',
            'new_shops.free_shipping_for_all',
            'new_shops.activation',
            'new_shops.created_at',
            'new_shops.updated_at'
        ]);

        return NewShopResource::collection($new_shops);
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
        $new_shop = new NewShop();
        $new_shop->image = $request->file('image')->store('new_shop_images');
        $new_shop->shop_name = $request->shop_name;
        $new_shop->merchant = $request->merchant;
        $new_shop->brand = $request->brand;
        $new_shop->category = $request->category;
        $new_shop->floor = $request->floor;
        $new_shop->mall = $request->mall;
        $new_shop->city = $request->city;
        $new_shop->selling_identity = $request->selling_identity;
        $new_shop->free_shipping_min_amount = $request->free_shipping_min_amount;
        $new_shop->free_shipping_for_all = $request->free_shipping_for_all;
        $new_shop->activation = $request->activation;

        if($new_shop->save()){
            return new NewShopResource($new_shop);
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
        $new_shop = NewShop::join('merchants','merchants.id','=','new_shops.merchant')
        ->join('brands','brands.id','=','new_shops.brand')
        ->join('product_categories','product_categories.id','=','new_shops.category')
        ->join('floors','floors.id','=','new_shops.floor')
        ->join('malls','malls.id','=','new_shops.mall')
        ->get([
            'new_shops.id',
            'new_shops.image',
            'new_shops.shop_name',
            'merchants.merchant_name',
            'brands.brand',
            'product_categories.category',
            'floors.floor_name',
            'malls.mall_name',
            'new_shops.city',
            'new_shops.selling_identity',
            'new_shops.free_shipping_min_amount',
            'new_shops.free_shipping_for_all',
            'new_shops.activation',
            'new_shops.created_at',
            'new_shops.updated_at'
        ])->where("id",$id);

        return new NewShopResource($new_shop);
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
        $new_shop = NewShop::findOrFail($id);
        $new_shop->shop_name = $request->shop_name;
        $new_shop->merchant = $request->merchant;
        $new_shop->brand = $request->brand;
        $new_shop->category = $request->category;
        $new_shop->floor = $request->floor;
        $new_shop->mall = $request->mall;
        $new_shop->city = $request->city;
        $new_shop->selling_identity = $request->selling_identity;
        $new_shop->free_shipping_min_amount = $request->free_shipping_min_amount;
        $new_shop->free_shipping_for_all = $request->free_shipping_for_all;
        $new_shop->activation = $request->activation;

        if($new_shop->save()){
            return new NewShopResource($new_shop);
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

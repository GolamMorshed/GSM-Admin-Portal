<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsedShop;
use App\Http\Resources\UsedShopResource;

class UsedShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $used_shops = UsedShop::join('merchants','merchants.id','=','used_shops.merchant')
        ->join('brands','brands.id','=','used_shops.brand')
        ->join('product_categories','product_categories.id','=','used_shops.category')
        ->join('floors','floors.id','=','used_shops.floor')
        ->join('malls','malls.id','=','used_shops.mall')
        ->get([
            'used_shops.id',
            'used_shops.image',
            'used_shops.client_name',
            'merchants.merchant_name',
            'brands.brand',
            'product_categories.category',
            'floors.floor_name',
            'malls.mall_name',
            'used_shops.selling_identity',
            'used_shops.free_shipping_min_amount',
            'used_shops.free_shipping_for_all',
            'used_shops.activation',
            'used_shops.created_at',
            'used_shops.updated_at'
        ]);
        return UsedShopResource::collection($used_shops);

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
        $used_shop = new UsedShop();
        $used_shop->image = $request->file('image')->store('used_shop_images');
        $used_shop->client_name = $request->client_name;
        $used_shop->merchant = $request->merchant;
        $used_shop->brand = $request->brand;
        $used_shop->category = $request->category;
        $used_shop->floor = $request->floor;
        $used_shop->mall = $request->mall;
        $used_shop->selling_identity = $request->selling_identity;
        $used_shop->free_shipping_min_amount = $request->free_shipping_min_amount;
        $used_shop->free_shipping_for_all = $request->free_shipping_for_all;
        $used_shop->activation = $request->activation;

        if($used_shop->save()){
            return new UsedShopResource($used_shop);
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
        $used_shop = UsedShop::join('merchants','merchants.id','=','used_shops.merchant')
        ->join('brands','brands.id','=','used_shops.brand')
        ->join('product_categories','product_categories.id','=','used_shops.category')
        ->join('floors','floors.id','=','used_shops.floor')
        ->join('malls','malls.id','=','used_shops.mall')
        ->get([
            'used_shops.id',
            'used_shops.image',
            'used_shops.client_name',
            'merchants.merchant_name',
            'brands.brand',
            'product_categories.category',
            'floors.floor_name',
            'malls.mall_name',
            'used_shops.selling_identity',
            'used_shops.free_shipping_min_amount',
            'used_shops.free_shipping_for_all',
            'used_shops.activation',
            'used_shops.created_at',
            'used_shops.updated_at'
        ])->where("id",$id);
        return new UsedShopResource($used_shop);
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
        $used_shop = UsedShop::findOrFail($id);
        $used_shop->client_name = $request->client_name;
        $used_shop->merchant = $request->merchant;
        $used_shop->brand = $request->brand;
        $used_shop->category = $request->category;
        $used_shop->floor = $request->floor;
        $used_shop->mall = $request->mall;
        $used_shop->selling_identity = $request->selling_identity;
        $used_shop->free_shipping_min_amount = $request->free_shipping_min_amount;
        $used_shop->free_shipping_for_all = $request->free_shipping_for_all;
        $used_shop->activation = $request->activation;

        if($used_shop->save()){
            return new UsedShopResource($used_shop);
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

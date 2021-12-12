<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OtherMall;
use App\Http\Resources\OtherMallResource;

class OtherMallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $other_malls = OtherMall::join('merchants','merchants.id','=','other_malls.merchant')
        ->join('brands','brands.id','=','other_malls.brand')
        ->join('product_categories','product_categories.id','=','other_malls.category')
        ->join('floors','floors.id','=','other_malls.floor')
        ->join('malls','malls.id','=','other_malls.mall')
        ->get([
            'other_malls.id',
            'other_malls.image',
            'other_malls.shop_name',
            'merchants.merchant_name',
            'brands.brand',
            'product_categories.category',
            'floors.floor_name',
            'malls.mall_name',
            'other_malls.city',
            'other_malls.selling_identity',
            'other_malls.free_shipping_min_amount',
            'other_malls.free_shipping_for_all',
            'other_malls.activation',
            'other_malls.created_at',
            'other_malls.updated_at'
        ]);
        return OtherMallResource::collection($other_malls);

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
          $other_mall = new OtherMall();
          $other_mall->image = $request->file('image')->store('other_mall');
          $other_mall->shop_name = $request->shop_name;
          $other_mall->merchant = $request->merchant;
          $other_mall->brand = $request->brand;
          $other_mall->category = $request->category;
          $other_mall->floor = $request->floor;
          $other_mall->mall = $request->mall;
          $other_mall->city = $request->city;
          $other_mall->selling_identity = $request->selling_identity;
          $other_mall->free_shipping_min_amount = $request->free_shipping_min_amount;
          $other_mall->free_shipping_for_all = $request->free_shipping_for_all;
          $other_mall->activation = $request->activation;

          if($other_mall->save()){
              return new OtherMallResource($other_mall);
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
        $other_mall = OtherMall::join('merchants','merchants.id','=','other_malls.merchant')
        ->join('brands','brands.id','=','other_malls.brand')
        ->join('product_categories','product_categories.id','=','other_malls.category')
        ->join('floors','floors.id','=','other_malls.floor')
        ->join('malls','malls.id','=','other_malls.mall')
        ->get([
            'other_malls.id',
            'other_malls.image',
            'other_malls.shop_name',
            'merchants.merchant_name',
            'brands.brand',
            'product_categories.category',
            'floors.floor_name',
            'malls.mall_name',
            'other_malls.city',
            'other_malls.selling_identity',
            'other_malls.free_shipping_min_amount',
            'other_malls.free_shipping_for_all',
            'other_malls.activation',
            'other_malls.created_at',
            'other_malls.updated_at'
        ])->where("id",$id);
        
       return new OtherMallResource($other_mall);
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
        $other_mall = OtherMall::findOrFail($id);
        $other_mall->shop_name = $request->shop_name;
        $other_mall->merchant = $request->merchant;
        $other_mall->brand = $request->brand;
        $other_mall->category = $request->category;
        $other_mall->floor = $request->floor;
        $other_mall->mall = $request->mall;
        $other_mall->city = $request->city;
        $other_mall->selling_identity = $request->selling_identity;
        $other_mall->free_shipping_min_amount = $request->free_shipping_min_amount;
        $other_mall->free_shipping_for_all = $request->free_shipping_for_all;
        $other_mall->activation = $request->activation;

        if($other_mall->save()){
            return new OtherMallResource($other_mall);
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

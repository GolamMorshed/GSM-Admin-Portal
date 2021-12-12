<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Http\Resources\PromotionResource;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::join('merchants','merchants.id','=','promotions.merchant')
        ->join('new_shops','new_shops.id','=','promotions.shop')
        ->join('malls','malls.id','=','promotions.mall')
        ->join('brands','brands.id','=','promotions.brand')
        ->join('sub_brands','sub_brands.id','=','promotions.brand')
        ->get([
            'promotions.id',
            'promotions.image',
            'promotions.promotion_title',
            'promotions.description',
            'promotions.start_date',
            'promotions.end_date',
            'promotions.url',
            'merchants.merchant_name',
            'new_shops.shop_name',
            'malls.mall_name',
            'brands.brand',
            'sub_brands.sub_brand',
            'promotions.promotion_by',
            'promotions.activation',
            'promotions.created_at',
            'promotions.updated_at'
        ]);
        return PromotionResource::collection($promotions);
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
        $promotion = new Promotion();
        $promotion->promotion_title = $request->promotion_title;
        $promotion->image = $request->file('image')->store('promotion_images');
        $promotion->description = $request->description;
        $promotion->start_date = $request->start_date;
        $promotion->end_date = $request->end_date;
        $promotion->url = $request->url;
        $promotion->merchant = $request->merchant;
        $promotion->shop = $request->shop;
        $promotion->mall = $request->mall;
        $promotion->brand = $request->brand;
        $promotion->sub_brand = $request->sub_brand;
        $promotion->promotion_by = $request->promotion_by;
        $promotion->activation = $request->activation;

        if($promotion->save()){
            return new PromotionResource($promotion);
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
        $promotion = Promotion::join('merchants','merchants.id','=','promotions.merchant')
        ->join('new_shops','new_shops.id','=','promotions.shop')
        ->join('malls','malls.id','=','promotions.mall')
        ->join('brands','brands.id','=','promotions.brand')
        ->join('sub_brands','sub_brands.id','=','promotions.brand')
        ->get([
            'promotions.id',
            'promotions.image',
            'promotions.promotion_title',
            'promotions.description',
            'promotions.start_date',
            'promotions.end_date',
            'promotions.url',
            'merchants.merchant_name',
            'new_shops.shop_name',
            'malls.mall_name',
            'brands.brand',
            'sub_brands.sub_brand',
            'promotions.promotion_by',
            'promotions.activation',
            'promotions.created_at',
            'promotions.updated_at'
        ])->where("id",$id);
        return new PromotionResource($promotion);
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
        $promotion = Promotion::findOrFail($id);
        $promotion->promotion_title = $request->promotion_title;
        $promotion->description = $request->description;
        $promotion->start_date = $request->start_date;
        $promotion->end_date = $request->end_date;
        $promotion->url = $request->url;
        $promotion->merchant = $request->merchant;
        $promotion->shop = $request->shop;
        $promotion->mall = $request->mall;
        $promotion->brand = $request->brand;
        $promotion->sub_brand = $request->sub_brand;
        $promotion->promotion_by = $request->promotion_by;
        $promotion->activation = $request->activation;

        if($promotion->save()){
            return new PromotionResource($promotion);
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

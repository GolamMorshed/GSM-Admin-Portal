<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $cart = new Cart();
        $cart->user_GUID = $request->user_GUID;
        $cart->sub_brand_details_id = $request->sub_brand_details_id;
        $cart->variation = $request->variation;
        $cart->quantity = $request->quantity;

        if($cart->save()){
            return new CartResource($cart);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_GUID)
    {

        // $cart = Cart::join('product_categories','product_categories.id','=','products.category')
        // ->get([
        //     'products.id','products.image',
        //     'products.product_name',
        //     'product_categories.category',
        //     'products.activation',
        //     'products.created_at',
        //     'products.updated_at'
        // ])->where("user_GUID",$user_GUID);
        // return new CartResource($cart);
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
        $cart = Cart::findOrFail($id);
        $cart->quantity = $request->quantity;

        if($cart->save()){
            return new CartResource($cart);
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
        $cart = Cart::findOrFail($id);

        if($cart->delete()){
            return new CartResource($cart);
        }
    }
}

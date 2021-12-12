<?php

namespace App\Http\Controllers;

use App\Models\MyFavourite;
use App\Http\Resources\MyFavouriteResource;
use Illuminate\Http\Request;

class MyFavouriteController extends Controller
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
        $myFavourite = new MyFavourite();
        $myFavourite->user_GUID = $request->user_GUID;
        $myFavourite->sub_brand_details_id = $request->sub_brand_details_id;

        if($myFavourite->save()){
            return new MyFavoriteResource($myFavourite);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MyFavourite  $myFavourite
     * @return \Illuminate\Http\Response
     */
    public function show(MyFavourite $myFavourite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MyFavourite  $myFavourite
     * @return \Illuminate\Http\Response
     */
    public function edit(MyFavourite $myFavourite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MyFavourite  $myFavourite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyFavourite $myFavourite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MyFavourite  $myFavourite
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyFavourite $myFavourite)
    {
        $myFavourite = MyFavorite::findOrFail($id);
        if($myFavourite->delete()){
            return new MyFavoriteResource($myFavourite);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreateAD;
use App\Http\Resources\CreateADResource;

class CreateADController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = CreateAD::join('a_d_clients','a_d_clients.id','=','create_a_d_s.ad_client')
        ->join('merchants','merchants.id','=','create_a_d_s.merchant')
        ->get([
            'create_a_d_s.id',
            'create_a_d_s.image',
            'create_a_d_s.ad_name',
            'create_a_d_s.selling_identity',
            'create_a_d_s.ad_caption',
            'a_d_clients.client_name',
            'merchants.merchant_name',
            'create_a_d_s.client_name',
            'create_a_d_s.ad_duration',
            'create_a_d_s.visual_identity',
            'create_a_d_s.created_at',
            'create_a_d_s.updated_at'
        ]);

        return CreateADResource::collection($ads);

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
        $ads = new CreateAD();
        $ads->image = $request->file('image')->store('advertisement_images');
        $ads->ad_name = $request->ad_name;
        $ads->selling_identity = $request->selling_identity;
        $ads->ad_caption = $request->ad_caption;
        $ads->ad_client = $request->ad_client;
        $ads->merchant = $request->merchant;
        $ads->client_name = $request->client_name;
        $ads->ad_duration = $request->ad_duration;
        $ads->visual_identity = $request->visual_identity;

        if($ads->save()){
            return new CreateADResource($ads);
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
        // $ads = CreateAD::findOrFail($id);
        $ads = CreateAD::join('a_d_clients','a_d_clients.id','=','create_a_d_s.merchant')
        ->join('merchants','merchants.id','=','create_a_d_s.merchant')
        ->get([
            'create_a_d_s.id',
            'create_a_d_s.image',
            'create_a_d_s.ad_name',
            'create_a_d_s.selling_identity',
            'create_a_d_s.ad_caption',
            'a_d_clients.client_name',
            'merchants.merchant_name',
            'create_a_d_s.client_name',
            'create_a_d_s.ad_duration',
            'create_a_d_s.visual_identity',
            'create_a_d_s.created_at',
            'create_a_d_s.updated_at'
        ])->where("id",$id);

        return new CreateADResource($ads);
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
        $ads = CreateAD::findOrFail($id);
        $ads->ad_name = $request->ad_name;
        $ads->selling_identity = $request->selling_identity;
        $ads->ad_caption = $request->ad_caption;
        $ads->ad_client = $request->ad_client;
        $ads->merchant = $request->merchant;
        $ads->client_name = $request->client_name;
        $ads->ad_duration = $request->ad_duration;
        $ads->visual_identity = $request->visual_identity;

        if($ads->save()){
            return new CreateADResource($ads);
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

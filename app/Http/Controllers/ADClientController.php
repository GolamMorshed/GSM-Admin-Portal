<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ADClient;
use App\Http\Resources\ADClientResource;

class ADClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ad_clients = ADClient::join('merchants','merchants.id','=','a_d_clients.merchant')
        ->get([
            'a_d_clients.id',
            'a_d_clients.ad_client',
            'merchants.merchant_name',
            'a_d_clients.client_name',
            'a_d_clients.selling_identity',
            'a_d_clients.reference_no',
            'a_d_clients.contact_number',
            'a_d_clients.contact_person',
            'a_d_clients.email',
            'a_d_clients.created_at',
            'a_d_clients.updated_at'
        ]);
        
        return ADClientResource::collection($ad_clients);
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
        $ad_client = new ADClient();
        $ad_client->ad_client = $request->ad_client;
        $ad_client->merchant = $request->merchant;
        $ad_client->client_name = $request->client_name;
        $ad_client->selling_identity = $request->selling_identity;
        $ad_client->reference_no = $request->reference_no;
        $ad_client->contact_number = $request->contact_number;
        $ad_client->contact_person = $request->contact_person;
        $ad_client->email = $request->email;

        if($ad_client->save()){
            return new ADClientResource($ad_client);
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
        //$ad_client = ADClient::findOrFail($id);
        $ad_client = ADClient::join('merchants','merchants.id','=','a_d_clients.merchant')
        ->get([
            'a_d_clients.id',
            'a_d_clients.ad_client',
            'merchants.merchant_name',
            'a_d_clients.client_name',
            'a_d_clients.selling_identity',
            'a_d_clients.reference_no',
            'a_d_clients.contact_number',
            'a_d_clients.contact_person',
            'a_d_clients.email',
            'a_d_clients.created_at',
            'a_d_clients.updated_at'
        ])->where("id",$id);

        return new ADClientResource($ad_client);
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
          $ad_client = ADClient::findOrFail($id);
          $ad_client->ad_client = $request->ad_client;
          $ad_client->merchant = $request->merchant;
          $ad_client->client_name = $request->client_name;
          $ad_client->selling_identity = $request->selling_identity;
          $ad_client->reference_no = $request->reference_no;
          $ad_client->contact_number = $request->contact_number;
          $ad_client->contact_person = $request->contact_person;
          $ad_client->email = $request->email;

          if($ad_client->save()){
              return new ADClientResource($ad_client);
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

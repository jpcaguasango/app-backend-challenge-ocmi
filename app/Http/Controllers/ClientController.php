<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Utils\Enums\Codes;
use App\Utils\Enums\Status;
use Illuminate\Support\Facades\Lang;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all data to table
        $clients = Client::all();

        // Build the response to be sent to the client
        $res = [
            "code" => Codes::SUCCESS,
            "status" => Status::SUCCESS,
            "message" => count($clients) > 0 ? Lang::get('validation.found_list') : Lang::get('validation.not_found'),
            "data" => $clients
        ];

        // Return the answer to the client
        return response()->json($res, $res['code']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        // Insert the model in the database
        $client = Client::create($request->all());


        // Build the response to be sent to the client
        $res = [
            "code" => $client ? Codes::SUCCESS : Codes::BAD_REQUEST,
            "status" => $client ? Status::SUCCESS : Status::ERROR,
            "message" => $client ? Lang::get('validation.created') : Lang::get('validation.not_created'),
            "data" => $client,
        ];

        // Return the answer to the client
        return response()->json($res, $res['code']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find data to table
        $client = Client::find($id);

        // Build the response to be sent to the client
        $res = [
            "code" => $client ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $client ? Status::SUCCESS : Status::ERROR,
            "message" => $client ? Lang::get('validation.found') : Lang::get('validation.not_found'),
            "data" => $client,
        ];

        // Return the answer to the client
        return response()->json($res, $res['code']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, string $id)
    {
        // Find data to table
        $client = Client::find($id);
        // Update data to table
        if ($client)
            $client->update($request->toArray());

        // Build the response to be sent to the client
        $res = [
            "code" => $client ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $client ? Status::SUCCESS : Status::ERROR,
            "message" => $client ? Lang::get('validation.updated') : Lang::get('validation.not_updated'),
            "data" => $client,
        ];

        // Return the answer to the client
        return response()->json($res, $res['code']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find data to table
        $client = Client::find($id);
        // Delete data to table
        if ($client)
            $client->delete();

        // Build the response to be sent to the client
        $res = [
            "code" => $client ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $client ? Status::SUCCESS : Status::ERROR,
            "message" => $client ? Lang::get('validation.deleted') : Lang::get('validation.not_deleted'),
            "data" => $client,
        ];

        // Return the answer to the client
        return response()->json($res, $res['code']);
    }
}

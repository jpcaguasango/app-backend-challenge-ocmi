<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Utils\Enums\Codes;
use App\Utils\Enums\Status;
use Illuminate\Support\Facades\Lang;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all data to table
        $permissions = Permission::all();

        // Build the response to be sent to the client
        $res = [
            "code" => Codes::SUCCESS,
            "status" => Status::SUCCESS,
            "message" => count($permissions) > 0 ? Lang::get('validation.found_list') : Lang::get('validation.not_found'),
            "data" => $permissions
        ];

        // Return the answer to the client
        return response()->json($res, $res['code']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        // Insert the model in the database
        $permission = Permission::create($request->all());


        // Build the response to be sent to the client
        $res = [
            "code" => $permission ? Codes::SUCCESS : Codes::BAD_REQUEST,
            "status" => $permission ? Status::SUCCESS : Status::ERROR,
            "message" => $permission ? Lang::get('validation.created') : Lang::get('validation.not_created'),
            "data" => $permission,
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
        $permission = Permission::find($id);

        // Build the response to be sent to the client
        $res = [
            "code" => $permission ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $permission ? Status::SUCCESS : Status::ERROR,
            "message" => $permission ? Lang::get('validation.found') : Lang::get('validation.not_found'),
            "data" => $permission,
        ];

        // Return the answer to the client
        return response()->json($res, $res['code']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, string $id)
    {
        // Find data to table
        $permission = Permission::find($id);
        // Update data to table
        if ($permission)
            $permission->update($request->toArray());

        // Build the response to be sent to the client
        $res = [
            "code" => $permission ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $permission ? Status::SUCCESS : Status::ERROR,
            "message" => $permission ? Lang::get('validation.updated') : Lang::get('validation.not_updated'),
            "data" => $permission,
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
        $permission = Permission::find($id);
        // Delete data to table
        if ($permission)
            $permission->delete();

        // Build the response to be sent to the client
        $res = [
            "code" => $permission ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $permission ? Status::SUCCESS : Status::ERROR,
            "message" => $permission ? Lang::get('validation.deleted') : Lang::get('validation.not_deleted'),
            "data" => $permission,
        ];

        // Return the answer to the client
        return response()->json($res, $res['code']);
    }
}

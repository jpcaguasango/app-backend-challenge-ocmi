<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRolePermissionsRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Utils\Enums\Codes;
use App\Utils\Enums\Status;
use Illuminate\Support\Facades\Lang;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all data to table
        $roles = Role::all();

        // Build the response to be sent to the client
        $res = [
            "code" => Codes::SUCCESS,
            "status" => Status::SUCCESS,
            "message" => count($roles) > 0 ? Lang::get('validation.found_list') : Lang::get('validation.not_found'),
            "data" => $roles
        ];

        // Return the answer to the client
        return response()->json($res, $res['code']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        // Insert the model in the database
        $role = Role::create($request->all());


        // Build the response to be sent to the client
        $res = [
            "code" => $role ? Codes::SUCCESS : Codes::BAD_REQUEST,
            "status" => $role ? Status::SUCCESS : Status::ERROR,
            "message" => $role ? Lang::get('validation.created') : Lang::get('validation.not_created'),
            "data" => $role,
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
        $role = Role::find($id);

        // Build the response to be sent to the client
        $res = [
            "code" => $role ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $role ? Status::SUCCESS : Status::ERROR,
            "message" => $role ? Lang::get('validation.found') : Lang::get('validation.not_found'),
            "data" => $role,
        ];

        // Return the answer to the client
        return response()->json($res, $res['code']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $id)
    {
        // Find data to table
        $role = Role::find($id);
        // Update data to table
        if ($role)
            $role->update($request->toArray());

        // Build the response to be sent to the client
        $res = [
            "code" => $role ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $role ? Status::SUCCESS : Status::ERROR,
            "message" => $role ? Lang::get('validation.updated') : Lang::get('validation.not_updated'),
            "data" => $role,
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
        $role = Role::find($id);
        // Delete data to table
        if ($role)
            $role->delete();

        // Build the response to be sent to the client
        $res = [
            "code" => $role ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $role ? Status::SUCCESS : Status::ERROR,
            "message" => $role ? Lang::get('validation.deleted') : Lang::get('validation.not_deleted'),
            "data" => $role,
        ];

        // Return the answer to the client
        return response()->json($res, $res['code']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePermissions(UpdateRolePermissionsRequest $request, string $id)
    {
        // Find data to table
        $role = Role::find($id);
        // Update data to table
        if ($role)
            $role->permissions()->sync($request->permissionIds);

        // Build the response to be sent to the client
        $res = [
            "code" => $role ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $role ? Status::SUCCESS : Status::ERROR,
            "message" => $role ? Lang::get('validation.updated') : Lang::get('validation.not_updated'),
            "data" => $role,
        ];

        // Return the answer to the client
        return response()->json($res, $res['code']);
    }
}

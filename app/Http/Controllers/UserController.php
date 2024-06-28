<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserRolesRequest;
use App\Utils\Enums\Codes;
use App\Utils\Enums\Status;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all data to table
        $users = User::all();

        // Build the response to be sent to the client
        $res = [
            "code" => Codes::SUCCESS,
            "status" => Status::SUCCESS,
            "message" => count($users) > 0 ? Lang::get('validation.found_list') : Lang::get('validation.not_found'),
            "data" => $users
        ];

        // Return the answer to the client
        return response()->json($res, $res['code']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // Insert the model in the database
        $user = User::create($request->all());


        // Build the response to be sent to the client
        $res = [
            "code" => $user ? Codes::SUCCESS : Codes::BAD_REQUEST,
            "status" => $user ? Status::SUCCESS : Status::ERROR,
            "message" => $user ? Lang::get('validation.created') : Lang::get('validation.not_created'),
            "data" => $user,
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
        $user = User::find($id);

        // Build the response to be sent to the client
        $res = [
            "code" => $user ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $user ? Status::SUCCESS : Status::ERROR,
            "message" => $user ? Lang::get('validation.found') : Lang::get('validation.not_found'),
            "data" => $user,
        ];

        // Return the answer to the client
        return response()->json($res, $res['code']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        // Find data to table
        $user = User::find($id);
        // Update data to table
        if ($user)
            $user->update($request->toArray());

        // Build the response to be sent to the client
        $res = [
            "code" => $user ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $user ? Status::SUCCESS : Status::ERROR,
            "message" => $user ? Lang::get('validation.updated') : Lang::get('validation.not_updated'),
            "data" => $user,
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
        $user = User::find($id);

        // Delete all roles assigned
        $user->roles()->detach();

        // Delete data to table
        if ($user)
            $user->delete();

        // Build the response to be sent to the client
        $res = [
            "code" => $user ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $user ? Status::SUCCESS : Status::ERROR,
            "message" => $user ? Lang::get('validation.deleted') : Lang::get('validation.not_deleted'),
            "data" => $user,
        ];

        // Return the answer to the client
        return response()->json($res, $res['code']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateRoles(UpdateUserRolesRequest $request, string $id)
    {
        // Find data to table
        $role = User::find($id);
        // Update data to table
        if ($role)
            $role->roles()->sync($request->roleIds);

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

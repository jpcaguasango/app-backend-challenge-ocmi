<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Utils\Enums\Codes;
use App\Utils\Enums\Status;
use Illuminate\Support\Facades\Lang;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all data to table
        $employees = Employee::all();

        // Build the response to be sent to the employee
        $res = [
            "code" => Codes::SUCCESS,
            "status" => Status::SUCCESS,
            "message" => count($employees) > 0 ? Lang::get('validation.found_list') : Lang::get('validation.not_found'),
            "data" => $employees
        ];

        // Return the answer to the employee
        return response()->json($res, $res['code']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        // Insert the model in the database
        $employee = Employee::create($request->all());


        // Build the response to be sent to the employee
        $res = [
            "code" => $employee ? Codes::SUCCESS : Codes::BAD_REQUEST,
            "status" => $employee ? Status::SUCCESS : Status::ERROR,
            "message" => $employee ? Lang::get('validation.created') : Lang::get('validation.not_created'),
            "data" => $employee,
        ];

        // Return the answer to the employee
        return response()->json($res, $res['code']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find data to table
        $employee = Employee::find($id);

        // Build the response to be sent to the employee
        $res = [
            "code" => $employee ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $employee ? Status::SUCCESS : Status::ERROR,
            "message" => $employee ? Lang::get('validation.found') : Lang::get('validation.not_found'),
            "data" => $employee,
        ];

        // Return the answer to the employee
        return response()->json($res, $res['code']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, string $id)
    {
        // Find data to table
        $employee = Employee::find($id);
        // Update data to table
        if ($employee)
            $employee->update($request->toArray());

        // Build the response to be sent to the employee
        $res = [
            "code" => $employee ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $employee ? Status::SUCCESS : Status::ERROR,
            "message" => $employee ? Lang::get('validation.updated') : Lang::get('validation.not_updated'),
            "data" => $employee,
        ];

        // Return the answer to the employee
        return response()->json($res, $res['code']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find data to table
        $employee = Employee::find($id);
        // Delete data to table
        if ($employee)
            $employee->delete();

        // Build the response to be sent to the employee
        $res = [
            "code" => $employee ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $employee ? Status::SUCCESS : Status::ERROR,
            "message" => $employee ? Lang::get('validation.deleted') : Lang::get('validation.not_deleted'),
            "data" => $employee,
        ];

        // Return the answer to the employee
        return response()->json($res, $res['code']);
    }
}

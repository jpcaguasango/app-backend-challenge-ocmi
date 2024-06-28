<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use App\Http\Requests\StoreTimesheetRequest;
use App\Http\Requests\UpdateTimesheetRequest;
use App\Utils\Enums\Codes;
use App\Utils\Enums\Status;
use Illuminate\Support\Facades\Lang;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all data to table
        $timesheets = Timesheet::all();

        // Build the response to be sent to the timesheet
        $res = [
            "code" => Codes::SUCCESS,
            "status" => Status::SUCCESS,
            "message" => count($timesheets) > 0 ? Lang::get('validation.found_list') : Lang::get('validation.not_found'),
            "data" => $timesheets
        ];

        // Return the answer to the timesheet
        return response()->json($res, $res['code']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTimesheetRequest $request)
    {
        // Insert the model in the database
        $timesheet = Timesheet::create($request->all());


        // Build the response to be sent to the timesheet
        $res = [
            "code" => $timesheet ? Codes::SUCCESS : Codes::BAD_REQUEST,
            "status" => $timesheet ? Status::SUCCESS : Status::ERROR,
            "message" => $timesheet ? Lang::get('validation.created') : Lang::get('validation.not_created'),
            "data" => $timesheet,
        ];

        // Return the answer to the timesheet
        return response()->json($res, $res['code']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find data to table
        $timesheet = Timesheet::find($id);

        // Build the response to be sent to the timesheet
        $res = [
            "code" => $timesheet ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $timesheet ? Status::SUCCESS : Status::ERROR,
            "message" => $timesheet ? Lang::get('validation.found') : Lang::get('validation.not_found'),
            "data" => $timesheet,
        ];

        // Return the answer to the timesheet
        return response()->json($res, $res['code']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTimesheetRequest $request, string $id)
    {
        // Find data to table
        $timesheet = Timesheet::find($id);
        // Update data to table
        if ($timesheet)
            $timesheet->update($request->toArray());

        // Build the response to be sent to the timesheet
        $res = [
            "code" => $timesheet ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $timesheet ? Status::SUCCESS : Status::ERROR,
            "message" => $timesheet ? Lang::get('validation.updated') : Lang::get('validation.not_updated'),
            "data" => $timesheet,
        ];

        // Return the answer to the timesheet
        return response()->json($res, $res['code']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find data to table
        $timesheet = Timesheet::find($id);
        // Delete data to table
        if ($timesheet)
            $timesheet->delete();

        // Build the response to be sent to the timesheet
        $res = [
            "code" => $timesheet ? Codes::SUCCESS : Codes::NOT_FOUND,
            "status" => $timesheet ? Status::SUCCESS : Status::ERROR,
            "message" => $timesheet ? Lang::get('validation.deleted') : Lang::get('validation.not_deleted'),
            "data" => $timesheet,
        ];

        // Return the answer to the timesheet
        return response()->json($res, $res['code']);
    }
}

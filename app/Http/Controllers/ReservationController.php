<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckAvailabilityRequest;
use App\Http\Requests\ReserveTableRequest;
use App\Reservations;

class ReservationController extends Controller
{
    public function checkTableAvailability(CheckAvailabilityRequest $request)
    {
        $table = $this->availableTableQuery($request->date_time, $request->table_id);

        if($table)
        {
            return response()->json(['table_available' => false]);
        }

        return response()->json(['table_available' => true]);
    }

    public function reserveTable(ReserveTableRequest $request)
    {
        $table = $this->availableTableQuery($request->from_time, $request->table_id);

        if($table)
        {
            return response()->json(['table_available' => false]);
        }

        return Reservations::create($request->all());
    }

    private function availableTableQuery($time, $tableId)
    {
        return Reservations::where([['from_time', '<=', $time], ['to_time', '>=', $time]])->where('table_id', $tableId)->first();
    }
}

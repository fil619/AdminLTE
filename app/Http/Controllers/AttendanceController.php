<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\attendance;

class AttendanceController extends Controller
{
  public function checkout(Request $request )
  {
    $employee_id = $request->employee_id ;
    $date = $request->date ;
    $checkout = $request->checkout ;

    $attendance = attendance::where('date', $date )
                            ->where('employee_id',$employee_id )
                            ->update(['checkout' => $checkout]);
  }
  public function checkin(Request $request )
  {
    $employee_id = $request->employee_id ;
    $date = $request->date ;
    $status = $request->status ;
    $checkin = $request->checkin ;
    $attendance = attendance::firstOrCreate(
        ['employee_id' => $employee_id , 'date' => $date  ],
        [
              'employee_id' => request('employee_id'),
              'date'        => request('date'),
              'status'      => request('status'),
              'checkin'     => request('checkin'),
        ]
    );
  }

}

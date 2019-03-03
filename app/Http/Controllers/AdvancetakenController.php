<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advancetaken;

class AdvancetakenController extends Controller
{
  public function store(Request $request)
  {
    $advance = Advancetaken::create([
      'emp_id'           => request('emp_id'),
      'date'           => request('date'),
      'amount'          => request('amount'),
      'reason'         => request('reason'),
    ]);
  }
  public function advancereport(Request $request)
  {
    $id =  $request->employee_id;
    $start =  $request->startdate;
    $end =  $request->enddate;
    $Billing = Advancetaken::where('emp_id' , '=' , $id)
                        ->whereBetween('date', [$start, $end])->orderBy('date', 'asc')->get();
return $Billing;

  }

}

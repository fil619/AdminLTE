<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Billing;

class BillingController extends Controller
{
  public function report(Request $request)
  {
    $id =  $request->employee_id;
    $start =  $request->startdate;
    $end =  $request->enddate;
    $Billing = Billing::where('emp_id' , '=' , $id)
                        ->whereBetween('date', [$start, $end])->orderBy('date', 'asc')->get();
return $Billing;

  }
}

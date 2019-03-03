<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repair;

class RepairController extends Controller
{
  public function empreport(Request $request)
  {
    $id =  $request->employee_id;
    $start =  $request->startdate;
    $end =  $request->enddate;
    $repair = Repair::where('emp_id' , '=' , $id)
                        ->whereBetween('date', [$start, $end])->orderBy('date', 'asc')->get();

                        return $repair;
  }
}

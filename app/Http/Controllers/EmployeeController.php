<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;

class EmployeeController extends Controller
{
  public function index()
  {
    $employee = employee::get();
    return response()->json([
        'employee'    => $employee,
    ], 200);
  }

  public function store(Request $request)
  {
    $request->session()->put('company_code','12CE67');
    $Company_Code = $request->session()->get('company_code');

    $event = employee::create([
      'employee_id'   => request('employee_id'),
      'company_code'   => $Company_Code,
      'first_name'   => request('first_name'),
      'last_name'   => request('last_name'),
      'dob'   => request('dob'),
      'address'   => request('address'),
      'telephone'    => request('telephone'),
      'phone_no'   => request('phone_no'),
      'email'     => request('email'),
      'adhar'  => request('adhar'),
      'type'   => request('type'),
      'joined_on'   => request('joined_on'),
      'password'   => request('password'),
    ]);

    return response()->json([
        'event'    => $event,
        'message' => 'Success'
    ], 200);
  }
  public function update(Request $request)
  {
    // return $request;
    $id = $request->id ;
    $employee = employee::find($id);
    $employee->employee_id = request('employee_id');
    $employee->first_name = request('first_name');
    $employee->last_name = request('last_name');
    $employee->dob = request('dob');
    $employee->address = request('address');
    $employee->telephone = request('telephone');
    $employee->phone_no = request('phone_no');
    $employee->email = request('email');
    $employee->adhar = request('adhar');
    $employee->type = request('type');
    $employee->password = request('password');
    $employee->joined_on = request('joined_on');
    $employee->save();
  }
}

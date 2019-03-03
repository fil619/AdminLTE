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
}

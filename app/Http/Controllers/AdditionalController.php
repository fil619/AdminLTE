<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Additional;

class AdditionalController extends Controller
{
  public function store(Request $request)
  {
    $advance = Additional::create([
      'emp_id'       => request('emp_id'),
      'vehicle'       => request('vehicle'),
      'date'          => request('date'),
      'amount'         => request('amount'),
      'work'         => request('work')
    ]);
  }
}

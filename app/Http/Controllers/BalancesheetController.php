<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\balancesheet;


class BalancesheetController extends Controller
{
  public function store(Request $request)
  {
    $this->validate($request, [

    ]);

    $balancesheet = balancesheet::create([
      'type'        => request('type'),
      'ledger'        => request('ledger'),
      'amount'      => request('amount'),
      'date'        => request('date'),
    ]);

    return response()->json([
        'balancesheet'    => $balancesheet,
        'message' => 'Success'
    ], 200);
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\balancesheet;
use Log;

class BalancesheetController extends Controller
{
  public function getdetails()
  {
    $capital = balancesheet::where('type', 'Investment')->get();
    $loan = balancesheet::where('type', 'Loan')->get();
    $liability = balancesheet::where('type', 'Current Liabilities')->get();
    return response()->json([
      'capital'    => $capital,
      'Loan'    => $loan,
      'Current'    => $liability,
    ], 200);
  }
  public function getcolumn()
  {
    $capital = balancesheet::where('type', 'Investment')->get();
    $loan = balancesheet::where('type', 'Loan')->get();
    $liability = balancesheet::where('type', 'Current Liabilities')->get();
    $capital = $capital->pluck('ledger');
    $loan = $loan->pluck('ledger');
    $liability = $liability->pluck('ledger');
    return response()->json([
      'capital'    => $capital,
      'Loan'    => $loan,
      'Current'    => $liability,
    ], 200);
  }
  public function getliabsum()
  {
    $capital = balancesheet::where('type', 'Investment')->sum('amount');
    $loan = balancesheet::where('type', 'Loan')->sum('amount');
    $Current = balancesheet::where('type', 'Current Liabilities')->sum('amount');
    $Liabilities = balancesheet::sum('amount');
    return response()->json([
      'Liabilities'=> $Liabilities,
      'capital'    => $capital,
      'Loan'    => $loan,
      'Current'    => $Current,
    ], 200);
  }

  public function store(Request $request)
  {
    $this->validate($request, [

    ]);

    $balancesheet = balancesheet::create([
      'type'        => request('type'),
      'ledger'        => request('ledger'),
      'amount'      => request('amount'),
      'TotalAmount'      => request('amount'),
      'date'        => request('date'),
    ]);

    return response()->json([
        'balancesheet'    => $balancesheet,
        'message' => 'Success'
    ], 200);
  }

  public function update(Request $request)
  {
    $investor = $request->investor ;
    $amount = $request->amount ;
    $credit = $request->type ;
    $balancesheet = balancesheet::where('ledger', '=', $investor)->first();
    if ($credit == 'Add')
    {
      $add = $balancesheet->increment('amount', $amount );
      $add = $balancesheet->increment('TotalAmount', $amount );
    }
    else if($credit == 'Withdraw' || 'Pay Installment')
    {
      $add = $balancesheet->decrement('amount', $amount );
    }

  }
}

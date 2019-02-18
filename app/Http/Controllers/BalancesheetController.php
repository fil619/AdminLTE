<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\balancesheet;


class BalancesheetController extends Controller
{
  public function getdetails()
  {
    $capital = balancesheet::where('type', 'Capital Accounts')->get();
    $loan = balancesheet::where('type', 'Loans')->get();
    $liability = balancesheet::where('type', 'Current Liabilities')->get();
    return response()->json([
      'capital'    => $capital,
      'Loan'    => $loan,
      'Current'    => $liability,
    ], 200);
  }

  public function getliabsum()
  {
    $capital = balancesheet::where('type', 'Capital Accounts')->sum('amount');
    $loan = balancesheet::where('type', 'Loans')->sum('amount');
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
      'date'        => request('date'),
    ]);

    return response()->json([
        'balancesheet'    => $balancesheet,
        'message' => 'Success'
    ], 200);
  }
}

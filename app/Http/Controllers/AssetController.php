<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;

class AssetController extends Controller
{
  public function index()
  {
    $fasset = Asset::where('assettype', 'Fixed Assets')->get();
    $casset = Asset::where('assettype', 'Current Assets')->get();
    return response()->json([
        'Fixed'    => $fasset,
        'Current' => $casset
    ], 200);
  }
  public function sum()
  {
    $total = Asset::sum('amount');
    $fasset = Asset::where('assettype', 'Fixed Assets')->sum('amount');
    $casset = Asset::where('assettype', 'Current Assets')->sum('amount');
    return response()->json([
      'assets'    => $total,
        'current'    => $casset,
        'fixed' => $fasset
    ], 200);
  }
  public function store(Request $request)
  {
    $this->validate($request, [

    ]);

    $Asset = Asset::create([
      'type'        => request('type'),
      'ledger'        => request('ledger'),
      'assettype'        => request('assettype'),
      'amount'      => request('amount'),
    ]);

    return response()->json([
        'Asset'    => $Asset,
        'message' => 'Success'
    ], 200);
  }
  public function addcash(Request $request)
  {
    $cash = $request->amount ;
    $Asset = Asset::where('ledger', 'Cash')->increment('amount',$cash );
    return 'Success';
  }
  public function subcash(Request $request)
  {
    $cash = $request->amount ;
    $Asset = Asset::where('ledger', 'Cash')->decrement('amount',$cash );
    return 'Success';
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;

class AssetController extends Controller
{
  public function store(Request $request)
  {
    $this->validate($request, [

    ]);

    $Asset = Asset::create([
      'type'        => request('type'),
      'ledger'        => request('ledger'),
      'assettype'        => request('assettype'),
      'amount'      => request('amount'),
      'date'        => request('date'),
    ]);

    return response()->json([
        'Asset'    => $Asset,
        'message' => 'Success'
    ], 200);
  }
}

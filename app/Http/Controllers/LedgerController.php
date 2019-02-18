<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ledger;
use DB;

class LedgerController extends Controller
{
  public function index()
  {
    $ledger = ledger::get();
    return response()->json([
        'ledger'    => $ledger,
    ], 200);
  }
  public function direct()
  {
    $ledger = ledger::where('type', 'Direct Expense')->get();
    $ledger = $ledger->pluck('name');
    return response()->json([
        'ledger'    => $ledger,
    ], 200);
  }
  public function indirect()
  {
    $ledger = ledger::where('type', 'Indirect Expense')->get();
    $ledger = $ledger->pluck('name');
    return response()->json([
        'ledger'    => $ledger,
    ], 200);
  }
  public function store(Request $request)
  {
    $ledger = ledger::create([
      'type'        => request('type'),
      'name'        => request('name'),
    ]);

    return response()->json([
        'ledger'    => $ledger,
        'message' => 'Success'
    ], 200);
  }
  public function update(Request $request  )
  {
    $id = $request->id ;
    $ledger = ledger::find($id);
    $ledger->name = request('name');
    $ledger->type = request('type');
    $ledger->save();
  }
}

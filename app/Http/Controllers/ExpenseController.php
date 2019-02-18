<?php

namespace App\Http\Controllers;
use App\Expense;
use Illuminate\Http\Request;
use DB;

class ExpenseController extends Controller
{
  public function index()
  {

  }
  public function getexpenses()
  {
    $Expense = Expense::get()->where('type', 'Direct');
    return response()->json([
        'Expense'    => $Expense,
    ], 200);
  }
  public function getiexpenses()
  {
    $Expense = Expense::get()->where('type', 'Indirect');
    return response()->json([
        'Expense'    => $Expense,
    ], 200);
  }
  public function store(Request $request)
  {
    $this->validate($request, [
        'narration' => 'required',
    ]);

    $expense = Expense::create([
      'type'        => request('type'),
      'ledger'        => request('ledger'),
      'amount'      => request('amount'),
      'date'        => request('date'),
      'narration' => request('narration'),
    ]);

    return response()->json([
        'expense'    => $expense,
        'message' => 'Success'
    ], 200);
  }
  public function update(Request $request ,Expense $expense)
  {
    $expense->type = request('type');
    $expense->amount = request('amount');
    $expense->ledger = request('ledger');
    $expense->date = request('date');
    $expense->narration = request('narration');
    $expense->save();
  }

  public function destroy( Request $request)
  {
    $id = $request->get('id');
    Expense::destroy($id);
     return  $id;
  }

}

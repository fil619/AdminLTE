<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\capitaldrawing;

class CapitaldrawingController extends Controller
{
  public function index()
  {
    $drawing = capitaldrawing::get();
    $sum = capitaldrawing::get();
    return response()->json([
      'drawing'    => $drawing,
      'sum'    => $sum,
    ], 200);
  }
  public function store(Request $request)
  {
    $drawing = capitaldrawing::create([
      'type'           => request('type'),
      'from'           => request('from'),
      'description'    => request('description'),
      'amount'         => request('amount'),
    ]);
  }
}

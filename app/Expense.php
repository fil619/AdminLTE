<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
  protected $fillable = [
    'type',
    'ledger',
    'amount',
    'date',
    'narration'
];
}

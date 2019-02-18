<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class balancesheet extends Model
{
  protected $fillable = [
    'type',
    'ledger',
    'amount',
    'date',
];
}

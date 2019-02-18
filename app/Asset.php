<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
  protected $fillable = [
    'type',
    'ledger',
    'assettype',
    'amount',
    'date',
];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class capitaldrawing extends Model
{
  protected $fillable = [
    'type',
    'from',
    'description',
    'amount'
];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advancetaken extends Model
{
  protected $fillable = [
    'emp_id',
    'date',
    'amount',
    'reason'
];
public $timestamps = false;
}

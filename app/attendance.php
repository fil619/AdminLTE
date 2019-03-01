<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
  protected $fillable = [
    'date',
    'employee_id',
    'status',
    'checkin',
    'checkout'
];
public $timestamps = false;
}

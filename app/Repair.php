<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
  protected $fillable = [
    'billno',
    'emp_id',
    'servicedetails',
    'servicecharge',
    'otherdetails',
    'othercharge',
    'date'
];
public $timestamps = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
  protected $fillable = [
    'billno',
    'date',
    'customerid',
    'total',
    'gsttotal',
    'discount',
    'grandtotal',
    'advance',
    'balance',
    'given',
    'returnable',
    'type',
    'transaction'
];
public $timestamps = false;
}

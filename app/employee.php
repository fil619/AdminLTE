<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
  protected $fillable = [
    'employee_id',
    'company_code',
    'first_name',
    'last_name',
    'dob',
    'address',
    'telephone',
    'phone_no',
    'email',
    'adhar',
    'type',
    'password',
    'joined_on'
  ];
}

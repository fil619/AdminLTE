<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class eventcalendar extends Model
{
  protected $fillable = [
    'title',
    'type',
    'start',
    'end',
    'allDay',
    'color'
];
}

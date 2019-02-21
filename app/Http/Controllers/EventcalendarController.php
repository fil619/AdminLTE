<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\eventcalendar;

class EventcalendarController extends Controller
{
  public function index()
  {
    $event = eventcalendar::get();
    return response()->json([
        'event'    => $event,
    ], 200);
  }
  public function store(Request $request)
  {
    $event = eventcalendar::create([
      'title'   => request('title'),
      'type'    => request('type'),
      'start'   => request('start'),
      'end'     => request('end'),
      'allDay'  => request('allDay'),
      'color'   => request('color'),
    ]);

    return response()->json([
        'event'    => $event,
        'message' => 'Success'
    ], 200);
  }

  public function update(Request $request ,eventcalendar $eventcalendar)
  {
    $id = $request->id ;
    $eventcalendar = eventcalendar::find($id);
    $eventcalendar->title = request('title');
    $eventcalendar->type = request('type');
    $eventcalendar->start = request('start');
    $eventcalendar->end = request('end');
    $eventcalendar->allDay = request('allDay');
    $eventcalendar->color = request('color');
    $eventcalendar->save();
  }

  public function dragevent(Request $request  )
  {
    $id = $request->id ;
    $event = eventcalendar::find($id);
    $event->start = request('start');
    $event->end = request('end');
    $event->save();

  }


    public function destroy( Request $request)
    {
      $id = $request->get('id');
      eventcalendar::destroy($id);
    }
}

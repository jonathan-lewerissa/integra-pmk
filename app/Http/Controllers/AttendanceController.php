<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param string $access_id
     * @return \Illuminate\Http\Response
     */
    public function show(string $access_id)
    {
        $event = Event::where('access_id', $access_id)->firstOrFail();
        return view('presensi', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $access_id)
    {
        $event = Event::where('access_id', $access_id)->firstOrFail();
        $attendance = $event->attendances()->create($request->all());

        return response()->json('');
    }
}

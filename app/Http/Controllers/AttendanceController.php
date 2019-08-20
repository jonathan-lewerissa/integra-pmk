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
        $event->makeHidden(['id', 'created_at', 'updated_at', 'shortened_link']);
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
        $attendance = $event->attendances()->firstOrCreate($request->all());

        $mahasiswa = $attendance->mahasiswa->only('nrp', 'nama');

        return response()->json($mahasiswa);
    }
}

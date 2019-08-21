<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
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
        $now = Carbon::now();
        $event = Event::where('access_id', $access_id)->firstOrFail();

        if($now > $event->start_date && $now < $event->end_date){
            $event['endpoint'] = route('a.update', ['a' => $event->access_id]);
            $event->makeHidden(['id', 'created_at', 'updated_at', 'shortened_link']);
            return view('presensi', compact('event'));
        }
        return redirect()->route('event.index');
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

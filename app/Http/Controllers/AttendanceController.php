<?php

namespace App\Http\Controllers;

use App\Event;
use App\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

        $event = $this->getEvent($access_id);

        if($now > $event->start_date && $now < $event->end_date){
            $event['endpoint'] = route('a.update', ['a' => $event->access_id]);
            if($event->show_attendance_count) {
                $event['attendance_count'] = $event->attendances->count();
            }
            $event->makeHidden(['id', 'created_at', 'updated_at', 'shortened_link', 'attendances']);
            return view('presensi', compact('event'));
        }
        return redirect()->route('event.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $access_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $access_id)
    {
        $event = $this->getEvent($access_id);

        $attendance = $event->attendances()->firstOrCreate($request->all());

        if($attendance) {
            $mahasiswa = Cache::remember('mahasiswa', now()->addMinutes(10), function () {
                return Mahasiswa::all();
            })->where('nrp',$request->nrp)->first();
        }

        return response()->json([
            'nama' => ($mahasiswa) ? $mahasiswa->nama : $attendance->nrp,
            'attendance_count' => $event->attendances->count(),
        ]);
    }

    /**
     * Get the event from cache or from database
     *
     * @param string $access_id
     * @return \App\Event  $event
     */
    private function getEvent(string $access_id)
    {
        $event = Cache::remember($access_id, now()->addMinutes(5), function () use ($access_id) {
            return Event::where('access_id', $access_id)->firstOrFail();
        });

        return $event;
    }
}

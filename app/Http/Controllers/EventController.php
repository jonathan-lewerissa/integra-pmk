<?php

namespace App\Http\Controllers;

use App\Event;
use App\Exports\EventAttendancesExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:create event']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')) {
            $roles = Role::all();
            $events = Event::with('roles', 'user.mahasiswa')->get();
        }
        else {
            $roles = Auth::user()->roles->except([2,3,4]);
            $events = Event::role($roles)->with('roles', 'user.mahasiswa')->get();
        }

        return view('event.index', compact('events', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dates = explode('-', $request->datetime);
        $request['start_date'] = Carbon::createFromFormat('d/m/Y H:i', trim($dates[0]));
        $request['end_date'] = Carbon::createFromFormat('d/m/Y H:i', trim($dates[1]));

        $request['show_attendance_count'] = ($request['show_attendance_count'] == 'on') ? 1 : 0;

        do {
            $request['access_id'] = Str::random(5);
        } while (Event::where('access_id', $request['access_id'])->first());

        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filepath = 'eventbackground';

            $s3_filepath = Storage::disk('public')->putFileAs(
                $filepath,
                $file,
                $request['access_id'].'.'.$file->clientExtension(),
                'public'
            );
            if($s3_filepath) {
                $request['background_image'] = $s3_filepath;
            }
        }

        $event = Auth::user()->events()->create($request->except(['datetime', 'gambar', 'role']));
        $event->assignRole($request->role);

        Cache::forget($event->access_id);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param \App\Event $event
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show(Request $request, Event $event)
    {
        $attendees = $event->attendances()->with('mahasiswa')->get();
        if($request->query('excel')){
            return Excel::download(new EventAttendancesExport($event, $attendees), $event->access_id . '.xlsx');
        }
        return view('event.show', compact('event', 'attendees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $dates = explode('-', $request->datetime);
        $request['start_date'] = Carbon::createFromFormat('d/m/Y H:i', trim($dates[0]));
        $request['end_date'] = Carbon::createFromFormat('d/m/Y H:i', trim($dates[1]));

        $request['show_attendance_count'] = ($request['show_attendance_count'] == 'on') ? 1 : 0;

        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filepath = 'eventbackground';

            if($event->background_image) {
                Storage::disk('public')->delete($event->background_image);
            }

            $s3_filepath = Storage::disk('public')->putFileAs(
                $filepath,
                $file,
                $event->access_id.'.'.$file->clientExtension(),
                'public'
            );
            if($s3_filepath) {
                $event->background_image = $s3_filepath;
            }
        }

        $event->fill($request->except('datetime', 'role', 'gambar'));
        $event->syncRoles($request->role);
        $event->save();

        Cache::forget($event->access_id);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if($event->background_image) {
            Storage::disk('public')->delete($event->background_image);
        }

        $event->delete();

        return back();
    }
}

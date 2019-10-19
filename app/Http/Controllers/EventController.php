<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
            $roles = Auth::user()->roles;
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

        do {
            $request['access_id'] = Str::random(8);
        } while (Event::where('access_id', $request['access_id'])->first());

        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filepath = 'eventbackground';

            $s3_filepath = Storage::disk('neo-s3')->putFileAs(
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

        Cache::put($event->access_id, $event, now()->addHours(2));

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $attendees = $event->attendances()->with('mahasiswa')->get();
        return view('event.show', compact('attendees'));
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

        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filepath = 'eventbackground';

            $s3_filepath = Storage::disk('neo-s3')->putFileAs(
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

        Cache::put($event->access_id, $event, now()->addHours(2));

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
        $event->delete();

        return back();
    }
}

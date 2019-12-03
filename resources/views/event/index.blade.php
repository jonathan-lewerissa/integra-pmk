@extends('adminlte::page')

@section('title', 'Event Dashboard')

@section('content_header')
    <h1>Event Dashboard</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>List of Events</h4>
                </div>
                <div class="box-body">
                    <div>
                        <p style="color: red;">* Link presensi baru bisa dibuka pada jam yang telah ditentukan</p>
                    </div>
                    <table id="tabel_event" class="display">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Created by</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{$event->id}}</td>
                                <td>
                                    <a href="{{route('a.show', ['a' => $event->access_id])}}" target="_blank" rel="noreferrer">{{$event->title}}</a>
                                </td>
                                <td>{{($event->user->mahasiswa) ? $event->user->mahasiswa->nama : $event->user->username}}</td>
                                <td>{{$event->description}}</td>
                                <td>{{$event->type}}</td>
                                <td>
                                    @if($event->start_date->format('Y-m-d') == $event->end_date->format('Y-m-d'))
                                        {{$event->start_date->format('d M Y, H:i')}} - {{$event->end_date->format('H:i')}}
                                    @else
                                        {{$event->start_date->format('d M Y H:i')}} - {{$event->end_date->format('d M Y H:i')}}
                                    @endif
                                </td>
                                <td>
                                    @if($event->background_image)
                                        <a href="{{$event->background_image}}">Background image</a>
                                    @else
                                        No image
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            Settings <span class="fa fa-caret-down"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{route('event.show', ['event'=>$event->id])}}" type="button"><span class="fa fa-user"></span>Attendance</a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#event_modal_{{$event->id}}"><span class="fa fa-pen"></span>Edit</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#" onclick="deleteEvent('#event_delete_{{$event->id}}')"><span class="fa fa-trash"></span>Delete</a></li>
                                        </ul>
                                    </div>
                                    <form method="post" style="display: none" id="event_delete_{{$event->id}}" action="{{route('event.destroy', ['event' => $event->id])}}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="event_modal_{{$event->id}}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                            <h4 class="modal-title">Edit Event</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form id="event_edit_{{$event->id}}" action="{{route('event.update', ['event' => $event->id])}}" method="post" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <label>Event Title</label>
                                                    <input type="text" class="form-control" name="title" placeholder="Title" value="{{$event->title}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <input type="text" class="form-control" name="description" placeholder="Description" value="{{$event->description}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Type</label>
                                                    <select class="form-control" name="type" disabled>
                                                        <option selected>{{$event->type}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Event by</label>
                                                    <select class="form-control multi-select" name="role">
                                                        @foreach($roles as $role)
                                                            <option @if($role->is($event->roles->first())) selected @endif>{{$role->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Event Date and Time</label>
                                                    <input type="text" class="form-control datetime" name="datetime" value="{{$event->start_date->format('d/m/Y H:i')}} - {{$event->end_date->format('d/m/Y H:i')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Show Attendance Count</label>
                                                    <br>
                                                    <input type="checkbox" name="show_attendance_count" {{$event->show_attendance_count ? 'checked' : ''}}>
                                                </div>
                                                <div class="form-group">
                                                    <label for="gambar">Background image</label>
                                                    <input type="file" name="gambar">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" form="event_edit_{{$event->id}}">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>Create New Event</h4>
                </div>
                <div class="box-body">
                    <form action="{{route('event.store')}}" method="post" id="create_event_form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Event Title *</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description *</label>
                            <input type="text" class="form-control" name="description" id="description" placeholder="Description" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" name="type" id="type">
                                <option selected>Mahasiswa</option>
                                <option>Umum</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="role">Event by</label>
                            <select class="form-control multi-select" name="role" id="role">
                                @foreach($roles as $role)
                                    <option>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="datetime">Event Date and Time</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="far fa-clock"></i></div>
                                <input type="text" class="form-control datetime" name="datetime" id="datetime">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Show Attendance Count</label>
                            <br>
                            <input type="checkbox" name="show_attendance_count" checked>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Background image</label>
                            <input type="file" name="gambar">
                        </div>
                    </form>
                </div>
                <div class="box-footer">
                    <button type="submit" form="create_event_form" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .swal2-container {
            zoom: 1.5;
        }
    </style>
@endsection

@section('js')
    <script>
        $(document).ready( function () {
            $('#tabel_event').DataTable({
                responsive: true,
            });

            $('.datetime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 5,
                timePicker24Hour: true,
                opens: 'left',
                drops: 'up',
                locale: {
                    format: 'DD/MM/YYYY HH:mm'
                },
            });

            let date_picker = $('#datetime').data('daterangepicker');
            date_picker.setStartDate(moment().startOf('hour'));
            date_picker.setEndDate(moment().startOf('hour').add(2, 'hour'));
            date_picker.drops = 'up';

            $('.multi-select').select2();
        } );

        const deleteEvent = (id) => {
            const content = {
                title: 'Are you sure you want to delete the event?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
            };
            submitForm(id, content);
        };

        const submitForm = (id, content) => {
            Swal.fire(content).then(result => {
                if(result.value) {
                    $(id).submit();
                }
            })
        }
    </script>
@endsection

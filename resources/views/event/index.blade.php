@extends('adminlte::page')

@section('title', 'Event Dashboard')

@section('content_header')
    <h1>Event Dashboard</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>List of Events</h4>
                </div>
                <div class="box-body">
                    <table id="tabel_event" class="display">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{$event->title}}</td>
                                <td>{{$event->description}}</td>
                                <td>{{$event->type}}</td>
                                <td>{{$event->start_date}} - {{$event->end_date}}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#event_modal_{{$event->id}}">Edit</button>
                                    <button type="submit" class="btn btn-danger" form="event_delete_{{$event->id}}">Delete</button>
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
                                            <form id="event_edit_{{$event->id}}" action="{{route('event.update', ['event' => $event->id])}}" method="post">
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
                                                    <select class="form-control" name="type">
                                                        <option selected>PJ</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Event Date and Time</label>
                                                    <input type="text" class="form-control datetime" name="datetime" value="{{$event->start_date->format('d/m/Y H:i')}} - {{$event->end_date->format('d/m/Y H:i')}}">
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
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>Create New Event</h4>
                </div>
                <div class="box-body">
                    <form action="{{route('event.store')}}" method="post" id="create_event_form">
                        @csrf
                        <div class="form-group">
                            <label for="title">Event Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" name="type" id="type">
                                <option selected>PJ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="datetime">Event Date and Time</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
                                <input type="text" class="form-control datetime" name="datetime" id="datetime">
                            </div>
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
    .daterangepicker {
        /*width: 10vh;*/
        /*height: 10vh;*/
    }
</style>
@endsection

@section('js')
    <script>
        $(document).ready( function () {
            $('#tabel_event').DataTable();

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
        } );
    </script>
@endsection

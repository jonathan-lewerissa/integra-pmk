@extends('adminlte::page')

@section('title', 'Event Dashboard')

@section('content_header')
    <h1>Event Dashboard</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>List of attendees</h4>
                </div>
                <div class="box-body">
                    <table id="tabel_event" class="display">
                        <thead>
                        <tr>
                            @if($event->type == 'Mahasiswa')
                            <th>NRP</th>
                            <th>Nama</th>
                            @else
                            <th>Nama</th>
                            <th>Asal</th>
                            @endif
                            <th>Jam</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($attendees as $attendee)
                            <tr>
                                @if($event->type == 'Mahasiswa')
                                <td>{{$attendee->nrp}}</td>
                                <td>{{($attendee->mahasiswa) ? $attendee->mahasiswa->nama : '-'}}</td>
                                @else
                                <td>{{$attendee->nama}}</td>
                                <td>{{$attendee->asal}}</td>
                                @endif
                                <td>{{$attendee->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer with-border">
                    <a class="btn btn-info" href="{{route('event.show', ['event' => $event->id, 'excel' => true])}}">
                        <span class="fa fa-arrow-down"></span> Download Excel
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
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
    </script>
@endsection

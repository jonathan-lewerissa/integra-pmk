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
                            <th>NRP</th>
                            <th>Nama</th>
                            <th>Jam</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($attendees as $attendee)
                            <tr>
                                <td>{{$attendee->nrp}}</td>
                                <td>{{($attendee->mahasiswa) ? $attendee->mahasiswa->nama : '-'}}</td>
                                <td>{{$attendee->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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

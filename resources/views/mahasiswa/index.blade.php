@extends('adminlte::page')

@section('title', 'Mahasiswa')

@section('content_header')
    <h1>Dashboard Mahasiswa</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h4>List Mahasiswa</h4>
                @if(Auth::user()->hasRole('admin'))
                    <div>
                        <a class="btn btn-info" href="{{route('mahasiswa-export')}}">Download Excel Mahasiswa</a>
                        <form action="{{route('mahasiswa-import')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="file" name="excel">
                            <button type="submit" class="btn btn-info">Import Mahasiswa</button>
                        </form>
                    </div>
                @endif
            </div>
            <div class="box-body">
                <table id="tabel_mahasiswa" class="display" width="100%">
                    <thead>
                    <tr>
                        <th data-priority="1">NRP</th>
                        <th data-priority="2">Nama</th>
                        <th>Departemen</th>
                        <th>Jenis Kelamin</th>
                        <th>HP</th>
                        @can('mahasiswa lihat detail')
                            <th>Email</th>
                            <th>Alamat Asal</th>
                            <th>Alamat Surabaya</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mahasiswas as $mahasiswa)
                        <tr>
                            <td>{{$mahasiswa->nrp}}</td>
                            <td>{{$mahasiswa->nama}}</td>
                            <td>{{$mahasiswa->departemen}}</td>
                            <td>{{$mahasiswa->jenis_kelamin}}</td>
                            <td>{{$mahasiswa->hp ? $mahasiswa->hp : "-" }}</td>
                            @can('mahasiswa lihat detail')
                                <td>{{$mahasiswa->email ? $mahasiswa->email : "-"}}</td>
                                <td>{{$mahasiswa->alamat_asal ? $mahasiswa->alamat_asal : "-"}}</td>
                                <td>{{$mahasiswa->alamat_surabaya ? $mahasiswa->alamat_surabaya : "-"}}</td>
                            @endcan
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready( function () {
            $('#tabel_mahasiswa').DataTable({
                responsive: true,
            });
        } );
    </script>
@endsection

@section('css')

@endsection

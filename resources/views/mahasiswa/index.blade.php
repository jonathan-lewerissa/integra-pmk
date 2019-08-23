@extends('adminlte::page')

@section('title', 'Mahasiswa')

@section('content_header')
    <h1>Dashboard Mahasiswa</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-info">
            <div class="box-header with-border">
                <h4>List Mahasiswa</h4>
                @if(Auth::user()->hasRole('admin'))
                    <form class="form-inline" method="post" enctype="multipart/form-data" action="{{route('mahasiswa-import')}}">
                        @csrf
                        <div class="form-group">
                            <a class="btn btn-info" href="{{route('mahasiswa-export')}}">Download Excel Mahasiswa</a>
                        </div>
                        <div class="form-group">
                            <input type="file" name="excel" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-info">Import Mahasiswa</button>
                    </form>
                @endif
            </div>
            <div class="box-body">
                <table id="tabel_mahasiswa" class="display" width="100%">
                    <thead>
                    <tr>
                        <th data-priority="1">NRP</th>
                        <th data-priority="2">Nama</th>
                        <th>Departemen</th>
                        <th>Angkatan</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mahasiswas as $mahasiswa)
                        <tr>
                            <td>{{$mahasiswa->nrp}}</td>
                            <td>{{$mahasiswa->nama}}</td>
                            <td>{{$mahasiswa->departemen}}</td>
                            <td>{{$mahasiswa->angkatan}}</td>
                            <td>
                                <a class="btn btn-info" href="{{route('mahasiswa.show',['mahasiswa' => $mahasiswa->nrp])}}">View Info</a>
                            </td>
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

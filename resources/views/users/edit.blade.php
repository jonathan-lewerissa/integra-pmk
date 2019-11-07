@extends('adminlte::page')

@section('title', 'User Dashboard')

@section('content_header')
    <h1>Users Dashboard</h1>
@endsection

@section('content')
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
            {{session('error')}}
        </div>
    @elseif(session('status'))
        <div class="alert alert-success alert-dismissable">
            {{session('status')}}
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>{{$user->username}}</h4>
                </div>
                <div class="box-body">
                    <form action="{{route('user.update', ['user' => $user->id])}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username" value="{{$user->username}}" @unless(Auth::user()->hasRole('admin')) disabled @endunless>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        @isset($roles)
                        <div class="form-group">
                            <label>Roles</label>
                            <select class="form-control multi-select" name="roles[]" multiple="multiple">
                                @foreach($roles as $role)
                                    @if($user->roles->contains($role))
                                        <option selected value="{{$role->name}}">{{$role->name}}</option>
                                    @else
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @endisset
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
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
            $('#tabel_user').DataTable({
                responsive: true,
            });

            $('.multi-select').select2();
        } );
    </script>
@endsection

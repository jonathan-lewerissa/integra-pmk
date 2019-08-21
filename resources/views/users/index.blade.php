@extends('adminlte::page')

@section('title', 'User Dashboard')

@section('content_header')
    <h1>Users Dashboard</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>List of Users</h4>
                </div>
                <div class="box-body">
                    <table id="tabel_user" class="display">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>{{$user->updated_at}}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#user_modal_{{$user->id}}">Edit</button>
                                    <button type="submit" class="btn btn-danger" form="user_delete_{{$user->id}}">Delete</button>
                                    <form method="post" style="display: none" id="user_delete_{{$user->id}}" action="{{route('user.destroy', ['user' => $user->id])}}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="user_modal_{{$user->id}}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                            <h4 class="modal-title">Edit User</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form id="user_edit_{{$user->id}}" action="{{route('user.update', ['user' => $user->id])}}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" name="username" placeholder="Username" value="{{$user->username}}">
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
                                                <div class="form-group">
                                                    <label>Roles</label>
                                                    <div class="form-group">
                                                        <label>Roles</label>
                                                        <select class="form-control" name="roles[]" multiple>
                                                            @foreach($roles as $role)
                                                                @if($user->roles->contains($role))
                                                                    <option selected>{{$role->name}}</option>
                                                                @else
                                                                    <option>{{$role->name}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" form="user_edit_{{$user->id}}">Save</button>
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
                    <h4>Create New User</h4>
                </div>
                <div class="box-body">
                    <form action="{{route('user.store')}}" method="post" id="create_user_form">
                        @csrf
                        <div class="form-group">
                            <label for="title">Username *</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                            <label>Roles</label>
                            <select class="form-control" name="roles[]" multiple>
                                @foreach($roles as $role)
                                    @if($role->name == 'mahasiswa')
                                        <option selected>{{$role->name}}</option>
                                    @else
                                        <option>{{$role->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="box-footer">
                    <button type="submit" form="create_user_form" class="btn btn-success">Submit</button>
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
        } );
    </script>
@endsection

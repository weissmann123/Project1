@extends('layouts.app')
@section('script')
<script>
 	$('document').ready(function(){
        $('#tableRole').DataTable({
            processing : true,
            serverSide : true,
            ajax : {
                "url" : "{{route('RoleDataTable')}}",
                "type" : "POST",
                "data" : {_token : "{{csrf_token()}}"},
            },
            columns : [
                {"data" : "id"},
                {"data" : "role"},
                {"data" : "user[, ]"},
                {"data" : "menu"},
                // {"data" : "user[, ]"},
                // {"data" : "menu[, ]"},
            ]
        });
    });
</script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Index Role</h2>
            </div>
            <div clas="pull-right">
                <a class="btn btn-success" href="{{route('employee.index')}}">Employee</a>
            </div>
        </div>
    </div>
    <div class="row" allign="left">
        <div class="pull-right">
            <a class="btn btn-success" href="{{route('role.create')}}">Add Role</a>
        </div>
    </div>
    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif
    <table class="table table-hover" id="tableRole">
        <thead>
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>User</th>
                <th>Menu</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($roles as $role)
            <tr>    
                <td>{{$role->id}}</td>
                <td>{{$role->role}}</td>
                <td>
                @foreach($role->employees as $roles)
                {{$roles->name}},
                @endforeach
                </td>
                <td>
                    <a href="{{ route('role.edit',[$role->id]) }}" class="btn btn-sm btn-info">Edit</a>
                    <a href="{{ route('role.destroy',$role->id) }}" class="btn btn-sm btn-danger">Delete</a>  
                </td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>
@endsection
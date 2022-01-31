@extends('layouts.app')

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
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>User</th>
                <th>Menu</th>
            </tr>
        </thead>
        @foreach($roles as $role)
        <tbody>
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
            <tr>
        </tbody>
        @endforeach
    </table>
@endsection
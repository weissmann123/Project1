@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Employee Index</h2>
            </div>
            <div clas="pull-right">
                <a class="btn btn-success" href="{{route('home')}}">Home</a>
            </div>
        </div>
    </div>
    <div class="row" allign="left">
        <div class="pull-right">
            <a class="btn btn-success" href="{{route('employee.create')}}">Add Employee</a>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{route('role.index')}}">Role</a>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{route('species.index')}}">Species</a>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{route('pet.index')}}">Pets</a>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{route('petname.index')}}">PetNames</a>
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
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Menu</th>
            </tr>
        </thead>
        @foreach($employees as $employee)
        <tbody>   
                {{-- @php
                    dd($employee->roles[0]->role);//tanpa nested loop
                @endphp   --}}
                <td>{{$employee->id}}</td>
                <td>{{$employee->name}}</td>
                <td>{{$employee->email}}</td>
                {{-- <td>{{$employee->role}}</tds> --}}
                {{-- <td>{{$data1}}</td> --}}
                <td>
                @foreach($employee->roles as $role)
                {{$role->role}},
                @endforeach
                </td>
                <td>
                    <a href="{{ route('employee.edit',[$employee->id]) }}" class="btn btn-sm btn-info">Edit</a>
                    <a href="{{ route('employee.destroy',$employee->id) }}" class="btn btn-sm btn-danger">Delete</a>  
                </td>
                @foreach($employee->pets as $pets)
                {{-- @php
                    dd($pets);
                @endphp --}}
                <tr>
                <td>{{$pets->birthdate}}</td>
                <td>{{$pets->petnames->name}}</td>
                <td>{{$pets->species->name}}</td>
                <td>{{$pets->employees->name}}</td>
                </td>
                @endforeach
        </tbody>
        @endforeach
    </table>
@endsection
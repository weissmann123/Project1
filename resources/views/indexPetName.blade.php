@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Pet Names Index</h2>
            </div>
            <div clas="pull-right">
                <a class="btn btn-success" href="{{route('home')}}">Home</a>
            </div>
        </div>
    </div>
    <div class="row" allign="left">
        <div class="pull-right">
            <a class="btn btn-success" href="{{route('petname.create')}}">Add PetName</a>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{route('employee.index')}}">Employeee</a>
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
                <th>id</th>
                <th>Name</th>
            </tr>
        </thead>
        @foreach($petNames as $name)
        <tbody>   
                {{-- @php
                    dd($employee->roles[0]->role);//tanpa nested loop
                @endphp   --}}
                @php
                //    dd($name->name);
                @endphp
                <td>{{$name->id}}</td>
                <td>{{$name->name}}</td>
                {{-- <td>
                @foreach($employee->roles as $role)
                {{$role->role}},
                @endforeach
                </td> --}}
                <td>
                    @php
                        // dd($name->id);
                    @endphp
                    <a href="{{ route('petname.edit',[$name->id]) }}" class="btn btn-sm btn-info">Edit</a>
                    <a href="{{ route('petname.destroy',$name->id) }}" class="btn btn-sm btn-danger">Delete</a>  
                </td>
            <tr>
        </tbody>
        @endforeach
    </table>
@endsection
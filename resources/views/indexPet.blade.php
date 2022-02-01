@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Pet Index</h2>
            </div>
            <div clas="pull-right">
                <a class="btn btn-success" href="{{route('home')}}">Home</a>
            </div>
        </div>
    </div>
    <div class="row" allign="left">
        <div class="pull-right">
            <a class="btn btn-success" href="{{route('pet.create')}}">Add Pets</a>
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
                <th>Birthdate</th>
                <th>Name</th>
                <th>Species</th>
                <th>Employee</th>
            </tr>
        </thead>
        @foreach($pets as $pets)
        <tbody>   
                @php
                    // dd($pet);
                    // dd($pet->petnames);
                    // dd($pets->petnames);
                @endphp
                {{-- <td>{{$pet->petname()->birthdate}}</td> --}}
                <td>{{$pets->birthdate}}</td>
                <td>{{$pets->petnames->name}}</td>
                <td>{{$pets->species->name}}</td>
                <td>{{$pets->employees->name}}</td>
                {{-- <td>
                @foreach($employee->roles as $role)
                {{$role->role}},
                @endforeach
                </td> --}}
                {{-- <td>
                    <a href="{{ route('pet.edit',[$pet->id]) }}" class="btn btn-sm btn-info">Edit</a>
                    <a href="{{ route('pet.destroy',$pet->id) }}" class="btn btn-sm btn-danger">Delete</a>  
                </td> --}}
            <tr>
        </tbody>
        @endforeach
    </table>
@endsection
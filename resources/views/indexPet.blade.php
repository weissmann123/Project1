@extends('layouts.app')
@section('script')
<script>
 	$('document').ready(function(){
        $('#tablePet').DataTable({
            processing : true,
            serverSide : true,
            ajax : {
                "url" : "{{route('PetDataTable')}}",
                "type" : "POST",
                "data" : {_token : "{{csrf_token()}}"},
            },
            columns : [
                {"data" : "id"},
                {"data" : "birthdate"},
                {"data" : "name"},
                {"data" : "species"},
                {"data" : "employee"},
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
    <table class="table table-hover" id="tablePet">
        <thead>
            <tr>
                <th width="20%">ID</th>
                <th width="20%">Birthdate</th>
                <th width="20%">Name</th>
                <th width="20%">Species</th>
                <th width="20%">Employee</th>
            </tr>
        </thead>
        <tbody> 
            {{-- @foreach($pets as $pets)  
                @php
                    // dd($pet);
                    // dd($pet->petnames);
                    // dd($pets->petnames);
                @endphp
                {{-- <td>{{$pet->petname()->birthdate}}</td> --}}
                {{-- <td>{{$pets->birthdate}}</td>
                <td>{{$pets->petnames->name}}</td>
                <td>{{$pets->species->name}}</td>
                <td>{{$pets->employees->name}}</td> --}}
                {{-- <td>
                @foreach($employee->roles as $role)
                {{$role->role}},
                @endforeach
                </td> --}}
                {{-- <td>
                    <a href="{{ route('pet.edit',[$pet->id]) }}" class="btn btn-sm btn-info">Edit</a>
                    <a href="{{ route('pet.destroy',$pet->id) }}" class="btn btn-sm btn-danger">Delete</a>  
                </td> --
                @endforeach --}}
        </tbody>
    </table>
@endsection
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add Pets</h2>
        </div>
        <div class="pull-right">

        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <form action="{{route('pet.store')}}" method="POST">
    @csrf
    <div class="col-sm-4">
        <div class="left">
            <strong>Birthdate</strong>
            <input type="date" name="birthdate" class="form-control" placeholder="Date">
        </div>

        {{-- <div class="left">
            <strong>Pets</strong>
            <input type="text" name="name" class="form-control" placeholder="Pets">
        </div> --}}

        <div class="left">
            <strong>Species</strong>
            <br>
             @foreach ($species as $species)
             {{-- @php
                 dd($species->id);
             @endphp --}}
                <input type="radio" name="species_id" value="{{$species->id}}">{{$species->name}}<br>
            @endforeach
        </div>
        <br>
        <div class="left">
            <strong>Employees</strong>
            <br>
             @foreach ($employees as $employees)
             {{-- @php
                 dd($species->id);
             @endphp --}}
                <input type="radio" name="employee_id" value="{{$employees->id}}">{{$employees->name}}<br>
            @endforeach
        </div>
    <br>
    <div class="left">
        <strong>Pet Names</strong>
        <br>
         @foreach ($petnames as $petnames)
         {{-- @php
             dd($species->id);
         @endphp --}}
            <input type="radio" name="petname_id" value="{{$petnames->id}}">{{$petnames->name}}<br>
        @endforeach
    </div>
    <div class=left>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>
    </form>
</div>
@endsection
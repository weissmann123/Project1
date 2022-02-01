@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Pet Name</h2>
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
    @php
        // dd($petname);
    @endphp
    <form action="{{route('petname.update', $petname->id)}}" method="POST">
        @csrf
        <div class="col-sm-4">
            <div class="form-group">
                <strong>Pets</strong>
                <input type="text" name="name" class="form-control" value="{{$petname->name}}" placeholder="Pets">
            </div>
            {{-- <div class="form-group">
                <strong>Birthdate</strong>
                <input type="date" name="birthdate" class="form-control" value="{{$petname->birthdate}}" placeholder="Birthdate">
            </div> --}}
            {{-- <div class="form-group">
                <strong>Species</strong>
                <input type="radio" name="species" class="form-control" value="{{$pet->birthdate}}" placeholder="Birthdate">
            </div> --}}
            <br>
            <div class="left">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection

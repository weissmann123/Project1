@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add Employee</h2>
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
    <form action="{{route('employee.store')}}" method="POST">
    @csrf
    <div class="col-sm-4">
        <div class="left">
            <strong>Name</strong>
            <input type="text" name="name" class="form-control" placeholder="Name">
            <strong>Email</strong>
            <input type="text" name="email" class="form-control" placeholder="Email">
            <strong>Password</strong>
            <input type="text" name="password" class="form-control" placeholder="Email">
            <strong>Roles</strong>
            <br>
            @foreach ($roles as $role)
            <input type="checkbox" name="role[]" value="{{$role->id}}"> {{$role->role}} <br/>
            @endforeach
            {{-- <input type="text" name="role" class="form-control" placeholder="Role"> --}}
            {{-- <input type="checkbox" id="1" name="role[]" value="Admin"> Admin <br/>
            <input type="checkbox" id="2" name="role[]" value="Programmer"> Programmer <br/>
            <input type="checkbox" id="3" name="role[]" value="UI"> UI <br/> --}}
        </div>
    <br>
    <div class=left>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>
    </form>
</div>
@endsection
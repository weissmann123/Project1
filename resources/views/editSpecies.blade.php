@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Species</h2>
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
    <form action="{{route('species.update', [$species->id])}}" method="POST">
        @csrf
        <div class="col-sm-4">
            <div class="form-group">
                <strong>Species</strong>
                <input type="text" name="species" class="form-control" value="{{$species->name}}" placeholder="Species">
            </div>
            <br>
            <div class="left">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection

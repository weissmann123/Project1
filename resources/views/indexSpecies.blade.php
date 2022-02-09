@extends('layouts.app')
@section('script')
<script>
    $('document').ready(function(){
       $('#tableSpecies').DataTable({
           processing : true,
           serverSide : true,
           ajax : {
               "url" : "{{route('SpeciesDataTable')}}",
               "type" : "POST",
               "data" : {_token : "{{csrf_token()}}"},
           },
           columns : [
               {"data" : "id"},
               {"data" : "name"},
               {"data" : "petname[, ]"},
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
                <h2>Species Index</h2>
            </div>
            <div clas="pull-right">
                <a class="btn btn-success" href="{{route('home')}}">Home</a>
            </div>
        </div>
    </div>
    <div class="row" allign="left">
        <div class="pull-right">
            <a class="btn btn-success" href="{{route('species.create')}}">Add Species</a>
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
    <table class="table table-hover" id="tableSpecies">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Pet Name</th>
                <th>Menu</th>
            </tr>
        </thead>
        <tbody> 
            {{-- @foreach($species as $species)  
                {{-- @php
                    dd($employee->roles[0]->role);//tanpa nested loop
                @endphp 
                <td>{{$species->id}}</td>
                <td>{{$species->name}}</td>
                <td>
                @foreach ($species->pets as $pets)
                    {{$pets->petnames->name}}
                @endforeach
                </td>
                <td>
                    <a href="{{ route('species.edit',[$species->id]) }}" class="btn btn-sm btn-info">Edit</a>
                    <a href="{{ route('species.destroy',$species->id) }}" class="btn btn-sm btn-danger">Delete</a>  
                </td>
                @endforeach --}}
        </tbody>
    </table>
@endsection
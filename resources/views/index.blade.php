@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Employee Index</h2>
            </div>
            {{--Demo JS--}}
            {{-- <button onclick="document.getElementById('demo').innerHTML=Date()">The time is?</button> --}}
            {{-- <p id="demo"></p> --}}
            {{-- <style>
                .class{
                    background-color : red;
                }
                #id{
                    background-color : blue;
                }
            </style> --}}
            <h5>id = Blue, class = Red</h5>
            <p id = "id"> Id</p>
            <p class = "class"> Class</p>
            <br>
            <h5>Variabel print</h5>
            <p id="script"></p>
            <button onclick="script_function()">show_var</button>
            <br>
            <h5>Alert print</h5>
            <button onclick="alert_function()">show_alert</button>
            <br>
            <h5>confirm print</h5>
            <p id="confirm"></p>
            <button onclick="confirm_function()">Confirm Button</button>
            <h5>Log inspect</h5>
            <button onclick="log_function()">show_log</button>
            <h5>doc ready</h5>
            <input type="button" id="test" value="click me"><br>
            <script>
                $('document').ready(function(){
                    $('#test').click(function(){
                        alert('button found and loaded');
                        document.body.style.backgroundColor = "yellow";
                    });
                });
                function script_function(){
                    var a, b;
                    a = "Hello";
                    b = "World";
                    // c = a + b;
                    document.getElementById("script").innerHTML = a + " " + b;
                }
                function alert_function(){
                    window.alert("Alert Button pressed");
                }
                function confirm_function(){
                    var x;
                    if(confirm("Select Option")){
                        x = "Confirmed";
                    }
                    else{
                        x = "Cancelled";
                    }
                    document.getElementById("confirm").innerHTML = x;
                }
                function log_function(){
                    var z, x;
                    z = "Hello";
                    x = "World";
                    console.log("Text = " + z + " " + x);
                }
            </script>
            {{--/Demo JS--}}
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
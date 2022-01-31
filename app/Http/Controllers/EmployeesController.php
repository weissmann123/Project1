<?php

namespace App\Http\Controllers;
// use App\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Roles;
use App\User;

class EmployeesController extends Controller
{
    public function index(){
        // $employees = Employees::all();
        // dd($employees);
        // return view('index',compact('employees','employees'));
        $employees = User::select('id','name','email','password')->get();
        return view('index')->with('employees',$employees);
    }
    public function create(){
        $roles = Roles::select('id','role','user')->get();
        return view('create')->with('roles',$roles);
    }
    public function store(Request $request){
        $data = $request->except('_method','_token','submit');
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'password' => 'required|string|min:5',
            'role' => 'required',
         ]);
        // dd($data);  
         $record = User::create($data);
         $record->roles()->sync($data['role']);
        return redirect()->route('employee.index')->with('success','employee added');
    }
    public function edit(User $employee){
        // $data = Employees::find($employee);
        $roles = Roles::select('id','role','user')->get();
        return view('edit')->with('employee',$employee)->with('roles',$roles);
    }
    public function update(Request $request,$id){
        $data = $request->except('_method','_token','submit');
        $validator = Validator::make($request->all(), [
           'name' => 'required|string|min:3',
        ]);
  
        if ($validator->fails()) {
           return redirect()->Back()->withInput()->withErrors($validator);
        }
        $test = User::find($id);
        $test->update($data);
        // dd($data);
        $test->roles()->sync($data['role']);
  
        // return Back()->withInput();
        return redirect()->route('employee.index')->with('success','employee edited ');
     }
    public function destroy(User $employee){
        // Employees::destroy($employee);
        $employee->roles()->sync([]);
        $employee->delete();
        return redirect()->route('employee.index')->with('success','employee deleted');
    }
}

//view('', compact('var')) var untuk variable di blade.php
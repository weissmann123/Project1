<?php

namespace App\Http\Controllers;
use App\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use App\Employees;
use App\User;

class RolesController extends controller{
    public function index(){
        // $employees = Employees::all();
        // dd($employees);
        // return view('index',compact('employees','employees'));
        $roles = Roles::select('id','role','user')->get();
        return view('indexRole')->with('roles',$roles);
    }
    public function create(){
        return view('createRole');
    }
    public function store(Request $request){
        $data = $request->except('_method','_token','submit');
        $validator = Validator::make($request->all(), [
            'role' => 'required',
         ]);
         $record = Roles::firstOrCreate($data);
        // Employees::create([
        //     'name' => $request->name,
        //     'email'=> $request->email,
        //     'role' => $request->role,
        //     'created_at' => now(),
        // ]);
        return redirect()->route('role.index')->with('success','role added');
    }
    public function edit(Roles $role){
        // $data = Employees::find($employee);
        // $employees=Employees::
        return view('editRole')->with('role',$role);
    }
    // public function update(Request $request, Employees $employee){
    //     $employee->update([
    //         'name' => $request->name,
    //         'email'=> $request->email,
    //         'role' => $request->role,
    //         'created_at' => now(),
    //     ]);
    //     $employee->save();
    //     return redirect()->route('employee.index')->with('success','employee updated');
    // }
    public function update(Request $request,$id){
        $data = $request->except('_method','_token','submit');
        //implode(", ", $data);
        $validator = Validator::make($request->all(), [
           'role' => 'required',
        ]);
  
        if ($validator->fails()) {
           return redirect()->Back()->withInput()->withErrors($validator);
        }
        $test = Roles::find($id);
        $test->update($data);
  
        // return Back()->withInput();
        return redirect()->route('role.index')->with('success','role edited ');
     }
    public function destroy(Roles $role){
        // Employees::destroy($employee);
        $role->employees()->sync([]);
        $role->delete();
        return redirect()->route('role.index')->with('success','role deleted');
    }
}
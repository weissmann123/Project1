<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Species;
use App\Pets;
use App\PetTables;
use App\Employees;
class PetNamesController extends Controller
{
    public function index(){
        // $employees = Employees::all();
        // dd($employees);
        // return view('index',compact('employees','employees'));
        $pets = Pets::select('id','name','birthdate')->get();
        return view('indexPet')->with('pets',$pets);
    }
    public function create(){
        // $species = Species::select('id','name')->get();
        return view('createPet');
    }
    public function store(Request $request){
        $data = $request->except('_method','_token','submit');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'birthdate'=> 'required',
         ]);
         $record = Pets::firstOrCreate($data);
        // Employees::create([
        //     'name' => $request->name,
        //     'email'=> $request->email,
        //     'role' => $request->role,
        //     'created_at' => now(),
        // ]);
        return redirect()->route('pet.index')->with('success','role added');
    }
    public function edit(Pets $pet){
        // $data = Employees::find($employee);
        // $employees=Employees::
        return view('editPet')->with('pet',$pet);
    }
    public function update(Request $request,$id){
        $data = $request->except('_method','_token','submit');
        //implode(", ", $data);
        $validator = Validator::make($request->all(), [
           'name' => 'required',
           'birthdate'=> 'required',
        ]);
  
        if ($validator->fails()) {
           return redirect()->Back()->withInput()->withErrors($validator);
        }
        $test = Pets::find($id);
        $test->update($data);
  
        // return Back()->withInput();
        return redirect()->route('pet.index')->with('success','role edited ');
     }
    public function destroy(Pets $pet){
        // Employees::destroy($employee);
        // $pet->employees()->sync([]);
        $pet->delete();
        return redirect()->route('pet.index')->with('success','role deleted');
    }
}

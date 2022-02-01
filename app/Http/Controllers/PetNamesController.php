<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Species;
use App\Pets;
use App\PetNames;
use App\User;
use Illuminate\Support\Facades\Validator;

class PetNamesController extends Controller
{
    public function index(){
        // $employees = Employees::all();
        // dd($employees);
        // return view('index',compact('employees','employees'));
        $petNames = PetNames::select('id','name')->get();
        return view('indexPetName')->with('petNames',$petNames);
    }
    public function create(){
        // $species = Species::select('id','name')->get();
        return view('createPetName');
    }
    public function store(Request $request){
        $data = $request->except('_method','_token','submit');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
         ]);
         $record = PetNames::firstOrCreate($data);
        // Employees::create([
        //     'name' => $request->name,
        //     'email'=> $request->email,
        //     'role' => $request->role,
        //     'created_at' => now(),
        // ]);
        return redirect()->route('petname.index')->with('success','pet name added');
    }
    public function edit($id){
        // $data = Employees::find($employee);
        // $employees=Employees::
        $petname = PetNames::find($id);
        return view('editPetName')->with('petname',$petname);
    }
    public function update(Request $request,$id){
        $data = $request->except('_method','_token','submit');
        //implode(", ", $data);
        $validator = Validator::make($request->all(), [
           'name' => 'required',
        ]);
  
        if ($validator->fails()) {
           return redirect()->Back()->withInput()->withErrors($validator);
        }
        $test = PetNames::find($id);
        $test->update($data);
  
        // return Back()->withInput();
        return redirect()->route('petname.index')->with('success','pet name edited ');
     }
    public function destroy($id){
        PetNames::destroy($id);
        // $pet->employees()->sync([]);
        // $petname->delete();
        return redirect()->route('petname.index')->with('success','pet name deleted');
    }
}

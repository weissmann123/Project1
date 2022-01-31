<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Species;

class SpeciesController extends Controller
{
    public function index(){
        // $employees = Employees::all();
        // dd($employees);
        // return view('index',compact('employees','employees'));
        $species = Species::select('id','name')->get();
        return view('indexSpecies')->with('species',$species);
    }
    public function create(){
        return view('createSpecies');
    }
    public function store(Request $request){
        $data = $request->except('_method','_token','submit');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
         ]);
         $record = Species::firstOrCreate($data);
        return redirect()->route('species.index')->with('success','species added');
    }
    public function edit(Species $species){
        // $data = Employees::find($employee);
        // $employees=Employees::
        return view('editSpecies')->with('species',$species);
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
        $test = Species::find($id);
        $test->update($data);
  
        // return Back()->withInput();
        return redirect()->route('species.index')->with('success','role edited ');
     }
    public function destroy(Species $species){
        // Employees::destroy($employee);
        // $pet->employees()->sync([]);
        $species->delete();
        return redirect()->route('species.index')->with('success','role deleted');
    }
}

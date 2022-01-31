<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pets;
use Illuminate\Support\Facades\Validator;
use App\Species;

class PetsController extends Controller
{
    public function index(){
        $pettables = PetTables::select('id')->get();
        return view('indexPetTables')->with('pettables',$pettables);
    }
    public function create(){
        $species = Species::select('id','name')->get();
        $pets = Pets::select('id','name','birthdate')->get();
        $employees = Employees::select('id','name')->get();
        return view('createPetTables')->with('species',$species)->with('pets',$pets)->with('employees',$employees);
    }
    public function store(Request $request){
        $data = $request->except('_method','_token','submit');
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'species_id'=> 'required',
            'pet_id'=> 'required',
         ]);
         $record = PetTables::firstOrCreate($data);
        // Employees::create([
        //     'name' => $request->name,
        //     'email'=> $request->email,
        //     'role' => $request->role,
        //     'created_at' => now(),
        // ]);
        return redirect()->route('pettab.index')->with('success','role added');
    }
}

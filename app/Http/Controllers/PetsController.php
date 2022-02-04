<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pets;
use App\PetNames;
use Illuminate\Support\Facades\Validator;
use App\Species;
use App\User;

class PetsController extends Controller
{
    public function index(){
        $pets = Pets::all();
        // dd($pets);
        return view('indexPet')->with('pets',$pets);
    }
    public function create(){
        $species = Species::select('id','name')->get();
        $petnames = PetNames::select('id','name')->get();
        $employees = User::select('id','name')->get();
        return view('createPet')->with('species',$species)->with('petnames',$petnames)->with('employees',$employees);
    }
    public function store(Request $request){
        $data = $request->except('_method','_token','submit');
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'species_id'=> 'required',
            'pet_id'=> 'required',
            'birthdate'=>'required'
         ]);
         $record = Pets::firstOrCreate($data);
        return redirect()->route('pet.index')->with('success','role added');
    }
}
//DB::beginTransaction()
//DB::commit()
//DB::rollback()
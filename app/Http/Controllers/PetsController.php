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
        $species = Species::select('id','name')->get();
        return view('indexPet')->with('pets',$pets)->with('species',$species);
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
    public function PetDataTable(Request $request){
        $column = array(
            0 => 'id',
            1 => 'birthdate',
            2 => 'name',
            3 => 'species',
            4 => 'employee',
        );
        // get param <-- ini fix g usa di rubah" 
        $limit = $request->input('length');
        $start = $request->input('start');
        $search = $request->input('search.value');
        $order = $column[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $draw = $request->input('draw');

        //buat filter dropdown
        $filter = $request->input('filter_option');
        
        $data = Pets::select('id','birthdate','petname_id','species_id','employee_id');
        $totalData = $data->count();
        $totalFiltered = $totalData;
        
        //buat dropdown
        if (isset($filter)) 
        {
            // mengikuti apa yang bisa d cari
            $data->orWhere('species_id','LIKE',"%{$filter}%");
            $totalFiltered = $data->count();
        }
        if (isset($search)) {
            $data->orWhere('birthdate','LIKE',"%{$search}%");
            $petnames = PetNames::orwhere('name','LIKE',"%{$search}%")->get();
            foreach($petnames as $petname)
            {
                $data->orwhere('petname_id','LIKE',"%{$petname->id}%");// orwhere biasanya dipakai setelah where
            }
            $totalFiltered = $data->count();
        }
        $data = $data->offset($start)
        ->limit($limit)
        ->get();
    
        $array = [];
        foreach ($data as $pet) {
            $nestedData['id'] = $pet->id;
            $nestedData['birthdate'] = $pet->birthdate;
            $nestedData['name'] = $pet->petnames->name;
            $nestedData['species'] = $pet->species->name;
            $nestedData['employee'] = $pet->employees->name;
            // dd($array);
            $array[] = $nestedData;
        }
        // ini juga fix
        $json_data = [
            'draw' => intval($draw),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFiltered),
            'data' => $array,
            // 'data' => $data->toArray(),
        ];
        // ini juga fix
        return json_encode($json_data);
            }
    }
//DB::beginTransaction()
//DB::commit()
//DB::rollback()
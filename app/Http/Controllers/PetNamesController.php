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
    public function PetNameDataTable(Request $request){
        $column = array(
            0 => 'id',
            1 => 'name',
            2 => 'species',
            3 => 'menu',
        );
        // get param <-- ini fix g usa di rubah" 
        $limit = $request->input('length');
        $start = $request->input('start');
        $search = $request->input('search.value');
        $order = $column[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $draw = $request->input('draw');
        
        $data = PetNames::select('id','name');
    
        $totalData = $data->count();
        $totalFiltered = $totalData;
    
        if (isset($search)) {
            // mengikuti apa yang bisa d cari
            $data->orWhere('name','LIKE',"%{$search}%");
            $totalFiltered = $data->count();
        }
        // $user = User::select('id','name');
        // if (isset($search)) {
        //     // mengikuti apa yang bisa d cari
        //     $user->orWhere('name','LIKE',"%{$search}%");
        //     $totalFiltered = $user->count();
        // }
        $data = $data->offset($start)
        ->limit($limit)
        ->get();
    
        $array = [];
        foreach($data as $petname) {
            $count = 0;
            $nestedData['id'] = $petname->id;
            $nestedData['name'] = $petname->name;
            foreach($petname->pets as $pets){
                $nestedData['species'][$count++] = $pets->species->name;
            }
            $edit = route('petname.edit',$petname->id);
            $delete = route('petname.destroy',$petname->id);
            $nestedData['menu'] = "<a href='{$edit}' class='btn btn-sm btn-info'>Edit</a> 
                                    <a href='{$delete}' class='btn btn-sm btn-danger'>Delete</a>";
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

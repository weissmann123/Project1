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
    public function SpeciesDataTable(Request $request){
        $column = array(
            0 => 'id',
            1 => 'name',
            2 => 'petname',
            3 => 'menu',
        );
        // get param <-- ini fix g usa di rubah" 
        $limit = $request->input('length');
        $start = $request->input('start');
        $search = $request->input('search.value');
        $order = $column[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $draw = $request->input('draw');
        
        $data = Species::select('id','name');
    
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
        foreach ($data as $species) {
            $count = [];
            $nestedData['id'] = $species->id;
            $nestedData['name'] = $species->name;
            foreach ($species->pets as $pet){
                // dd($test);
                $count[] = $pet->petnames->name;
                // $count++;
                // dd($array['user']);    
            }
            $nestedData['petname'] = $count;
            $edit = route('species.edit',$species->id);
            $delete = route('species.destroy',$species->id);
            $nestedData['menu'] = "<a href='{$edit}' class='btn btn-sm btn-info'>Edit</a> 
                                    <a href='{$delete}' class='btn btn-sm btn-danger'>Delete</a>";
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

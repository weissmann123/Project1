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
    public function UserDataTable(Request $request){
        $column = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'role',
            4 => 'pet',
            5 => 'menu',
        );
        // get param <-- ini fix g usa di rubah" 
        $limit = $request->input('length');
        $start = $request->input('start');
        $search = $request->input('search.value');
        $order = $column[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $draw = $request->input('draw');
        
        $data = User::select('id','name','email');
    
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
        foreach($data as $employees) {
            $count1 = 0;
            $count2 = 0;
            $nestedData['id'] = $employees->id;
            $nestedData['name'] = $employees->name;
            $nestedData['email'] = $employees->email;
            foreach($employees->roles as $role){
                $nestedData['role'][$count1++] = $role->role;
            }
            foreach($employees->pets as $pets){
                $nestedData['pet'][$count2++] = $pets->birthdate;
                $nestedData['pet'][$count2++] = $pets->petnames->name;
                $nestedData['pet'][$count2++] = $pets->species->name;
            }
            $edit = route('employee.edit',$employees->id);
            $delete = route('employee.destroy',$employees->id);
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

//view('', compact('var')) var untuk variable di blade.php
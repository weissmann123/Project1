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
    public function RoleDataTable(Request $request){
    $column = array(
        0 => 'id',
        1 => 'role',
        2 => 'user',
        3 => 'menu',
    );
    // get param <-- ini fix g usa di rubah" 
    $limit = $request->input('length');
    $start = $request->input('start');
    $search = $request->input('search.value');
    $order = $column[$request->input('order.0.column')];
    $dir   = $request->input('order.0.dir');
    $draw = $request->input('draw');

    $data = Roles::select('id','role');

    $totalData = $data->count();
    $totalFiltered = $totalData;

    if (isset($search)) {
        // mengikuti apa yang bisa d cari
        $data->orWhere();
        $totalFiltered = $data->count();
    }

    $data = $data->offset($start)
    ->limit($limit)
    ->get();

    $array = [];
    foreach ($data as $datas) {
        // $array['customer'] = $transaction->user->first_name.' '.$transaction->user->last_name;
        // $action = '';
        // if () {
        //     $action .= '<a href="'.asset('storage/'.$file->file_location).'" download>Download</a>';
        // }
        // $array['action'] = $action;
        $nestedData['id'] = $datas->id;
        $nestedData['role'] = $datas->role;
        foreach ($datas->employees as $test){
            // dd($test);
            $nestedData['user'][] = $test->name;
            // dd($array['user']);    
        }
        $nestedData['user'][] = " ";
        $nestedData['menu'] = "<a href='{{ route('role.edit',$datas->id) }}' class='btn btn-sm btn-info'>Edit</a> 
                          <a href='{{ route('role.destroy',$datas->id) }}' class='btn btn-sm btn-danger'>Delete</a>";
        $array[] = $nestedData;
        // $array['menu'] = "<button>CLICK ME</button>";
    }
    // ini juga fix
    $json_data = [
        'draw' => intval($draw),
        'recordsTotal' => intval($totalData),
        'recordsFiltered' => intval($totalFiltered),
        'data' => $array,
    ];
    // ini juga fix
    return json_encode($json_data);
        }
    }
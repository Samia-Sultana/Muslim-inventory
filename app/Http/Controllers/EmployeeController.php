<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role as ModelsRole;

class EmployeeController extends Controller
{
    public function index(){
        $roles = ModelsRole::all();
        return view('createEmployee', compact('roles'));
    }
    public function create(Request $request){
        $all = $request->all();
        $user = User::create([
            'name' => $all['name'],
            'email' => $all['email'],
            'password' => Hash::make($all['password']),
        ]);
        DB::table('model_has_roles')->insert([
            'role_id' => $all['role'],
            'model_type' => 'App\Models\User',
            'model_id' => $user['id']
        ]);

        return redirect()->route('addEmployeePage');
    }
    public function role(){
        return view('createRole');
    }
    public function store(Request $request){
        $all = $request->all();
        ModelsRole::create([
            'name' => $all['name'],
            'guard_name' => 'web',
        ]);
        return redirect()->route('addRolePage');
    }
}

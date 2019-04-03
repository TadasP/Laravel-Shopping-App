<?php

namespace App\Http\Controllers\Back;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        $data['roles'] = Role::all();
        $user = Auth::user();

        if($user->hasRole('Super Admin')){
            return view('admin.roles.list', $data);
        }else{
            return redirect(route('home'));
        }
    }

    public function create()
    {
        $user = Auth::user();

        /* if($user->hasRole('Super Admin')){ */
            return view('admin.roles.create');
        /* }else{
            return redirect(route('home'));
        } */
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $role = Role::create(['name' => $name]);
        return redirect(route('roles.index'));
    }

    public function show($id)
    {
        return redirect( route('home') );
    }

    public function edit($id)
    {
        return redirect( route('home') );
    }

    public function update(Request $request, $id)
    {
        return redirect( route('home') );
    }

    public function destroy($id)
    {
        return redirect( route('home') );
    }

    public function asignPermission()
    {
        $data['roles'] = Role::all();
        $data['permissions'] = Permission::all();
        $user = Auth::user();

        if($user->hasRole('Super Admin')){
            return view('admin.roles.asign-permissions', $data);
        }else{
            return redirect(route('home'));
        }
    }

    public function storePermission(Request $request)
    {
        $id = $request->role;
        $permissions = $request->permissions;
        $role = Role::find($id);
        $role->syncPermissions($permissions);            
        return redirect(route('roles.index'));
    }

    public function asignRole()
    {
        $data['roles'] = Role::all();
        $data['users'] = User::all();
        $user = Auth::user();

        if($user->hasRole('Super Admin')){
            return view('admin.roles.asign-roles', $data);
        }else{
            return redirect(route('home'));
        }
    }

    public function storeRole(Request $request)
    {

        $id = $request->role;
        $users = $request->users;
        $role = Role::find($id);
        foreach($users as $oneuser){ 
            $user = User::find($oneuser);
            $user->assignRole($role->name);
        }
        return redirect(route('roles.index'));
    }

}

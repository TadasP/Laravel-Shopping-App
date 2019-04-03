<?php

namespace App\Http\Controllers\Back;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index()
    {
        $data['permissions'] = Permission::all();
        $user = Auth::user();

        if($user->hasRole('Super Admin')){
            return view('admin.permissions.list', $data);
        }else{
            return redirect( route('home'));
        }
    }

    public function create()
    {   
        $user = Auth::user();

        if($user->hasRole('Super Admin')){
            return view('admin.permissions.create');
        }else{
            return redirect( route('home'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $name = $request->name;
        $permission = Permission::create(['name' => $name]);
        return redirect(route('permissions.index'));
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
}

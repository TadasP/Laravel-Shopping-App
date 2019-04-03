<?php

namespace App\Http\Controllers\Back;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $data['users'] = User::paginate(8);
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.users.list', $data);
        }else{
            return redirect(route('home'));
        }
    }

    public function create()
    {
        return redirect( route('home') );
    }

    public function store(Request $request)
    {
        return redirect( route('home') );
    }

    public function show($id)
    {
        $data['user'] = User::find($id);
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.users.show', $data);
        }else{
            return redirect(route('home'));
        }
    }

    public function edit($id)
    {
        $data['user'] = User::find($id);
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.users.edit', $data);
        }else{
            return redirect(route('home'));
        } 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|max:225'
        ]);
        
        $password = Hash::make($request->password);
        User::where('id', $id)
                ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => $password
                        ]);
        return redirect( route('users.index') );
    }

    public function destroy($id)
    {
        User::where('id', $id)->update(['active' => 0]);
        return redirect( route('users.index') );
    }
}

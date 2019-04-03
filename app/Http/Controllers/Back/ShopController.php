<?php

namespace App\Http\Controllers\Back;

use App\Shop;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index()
    {
        $data['shops'] = Shop::paginate(8);
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.shops.list', $data);
        }else{
            return redirect(route('home'));
        }
    }

    public function create()
    {
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.shops.create');
        }else{
            return redirect(route('home'));
        }
    }

    public function store(Request $request)
    {
        $shop = new Shop();
        $shop->owner_id = Auth::user()->id;
        $shop->shop_name = $request->name;
        $shop->shop_address = $request->address;
        $shop->shop_phone = $request->phone;
        $shop->shop_code = $request->company_code;
        $shop->pvm_code = $request->pvm_code;
        $shop->save();
        return redirect(route('admin.shops'));
    }

    public function show($id)
    {
        $shop = Shop::find($id);
        $owner = User::find($shop->owner_id);
        $data['shop'] = $shop;
        $data['owner'] = $owner;
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.shops.show', $data);
        }else{
            return redirect(route('home'));
        }
    }

    public function edit($id)
    {
        $data['shop'] = Shop::find($id);
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.shops.edit', $data); 
        }else{
            return redirect(route('home'));
        }
    }

    public function update(Request $request, $id)
    {
        Shop::where('id', $id)
                ->update([
                        'shop_name' => $request->name,
                        'shop_address' => $request->address,
                        'shop_phone' => $request->phone,
                        'shop_code' => $request->company_code,
                        'pvm_code' => $request->pvm_code
                        ]);
         return redirect( route('shops.index') );
    }

    public function destroy($id)
    {
        Shop::where('id', $id)->update(['active' => 0]);
        return redirect( route('shops.index') );
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Shop;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;

class FrontShopController extends Controller
{
    public function index()
    {
        $data['shops'] = Shop::where('active',1)->paginate(9);
        return view('front.shops.list', $data);
    }

    public function create()
    {
        return view('front.shops.create');
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

        $user = User::find(Auth::user()->id);
        $user->assignRole('Reseller');

        return redirect( route('shopping.own-shops') );
    }

    public function show($id)
    {
        $shop = Shop::find($id);
        $data['shop'] = $shop;
        if($shop->active == 1){
            return view('front.shops.show', $data);
        }else{
            return redirect(route('home'));
        }     
    }

    public function edit($id)
    {
        $shop = Shop::find($id);
        $data['shop'] = $shop;
        if($shop->owner_id == Auth::user()->id && $shop->active == 1){
            return view('front.shops.edit', $data);
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
        return redirect( route('shopping.own-shops') );
    }

    public function destroy($id)
    {
        $shop = Shop::find($id);
        if($shop->owner_id == Auth::user()->id && $shop->active == 1){
            Shop::where('id', $id)->update(['active' => 0]);
            return redirect( route('shopping.index') );
        }else{
            return redirect(route('home'));    
        }
    }

    public function ownShops()
    {
        $data['shops'] = Shop::where('owner_id', Auth::user()->id)->where('active',1)->get();
        return view('front.shops.ownshops', $data);
    }
}

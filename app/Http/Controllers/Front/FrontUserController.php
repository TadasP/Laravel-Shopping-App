<?php

namespace App\Http\Controllers\Front;

use App\User;
use App\Contact;
use App\Shop;
use App\Post;
use App\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontUserController extends Controller
{

    public function index()
    {
        return redirect( route('home') );
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
        $user = User::find($id);
        $data['user'] = $user;

        $userShopsIds = [];
        $shopAmount = 0;
        $productAmount = 0;
        $postAmount = 0;

        $shops = Shop::where('owner_id', $id)->where('active',1)->get();
        foreach($shops as $shop){
            $userShopsIds[] = $shop->id;
            $shopAmount++;
        }

        $posts = Post::where('user_id', $id)->where('active',1)->get();
        foreach($posts as $post){
            $postAmount++;
        }

        $products = Product::whereIn('shop_id', $userShopsIds)->where('active',1)->get();
        foreach($products as $product){
            $productAmount++;
        }

        $data['shops'] = $shopAmount;
        $data['posts'] = $postAmount;
        $data['products'] = $productAmount;

        if($user->active == 1){
            return view('front.users.show', $data);
        }else{
            return redirect( route('home'));   
        }
        
    }

    public function edit($id)
    {
        $user = User::find($id);
        $data['user'] = $user;
        $data['contact'] = Contact::where('user_id', $id)->first();
        if($user->id == Auth::user()->id && $user->active == 1){
            return view('front.users.edit', $data);
        }else{
            return redirect(route('home'));
        } 
    }

    public function update(Request $request, $id)
    {
        User::where('id', $id)
                ->update([
                        'name' => $request->name,
                        'email' => $request->email
                        ]);
        
        $userContacts = Contact::where('user_id', $id)->first();

        if($userContacts){
            Contact::where('user_id', $id)
            ->update([
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'photo' => $request->photo
            ]);     
        }else{
            $contact = new Contact();
            $contact->user_id = $id;

            $contact->phone = $request->phone ? $request->phone : NULL;
            $contact->address = $request->address ? $request->address : NULL;
            $contact->photo = $request->photo ? $request->photo : 'https://www.viawater.nl/files/default-user.png';

            $contact->save();
              
        }
        return redirect( route('frontusers.show', $id) );
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($user->id == Auth::user()->id && $user->active == 1){
            User::where('id', $id)->update(['active' => 0]);
            return redirect( route('users.index'));
        }else{
            return redirect(route('home'));
        }
    }
}

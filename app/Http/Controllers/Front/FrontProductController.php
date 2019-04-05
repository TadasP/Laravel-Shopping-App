<?php

namespace App\Http\Controllers\Front;

use App\Product;
use App\Category;
use App\Shop;
use App\CategoryProductRelation;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Back\CategoryController;


class FrontProductController extends Controller
{
    
    public function index()
    {
        $data['products'] = Product::where('active',1)->paginate(9);
        return view('front.products.list', $data);
    }

    public function create()
    {
        $data['shops'] = Shop::where('owner_id', Auth::user()->id)->where('active',1)->get();
        $categories = new CategoryController();
        $data['categories'] = $categories->getProductCategoryTree();
        return view('front.products.create', $data);
    }

    public function store(Request $request)
    {
        $shop = Shop::find($request->shop_id);

        if($shop->owner_id !== Auth::user()->id){
            return redirect(route('home'));
        }

        $request->validate([
            'shop_id' => 'required|numeric',
            'name' => 'required|max:50',
            'category' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'qty' => 'required|numeric',
            'img' => 'required'
        ]);

        $slug = Str::slug($request->name, '-');

        $product = new Product();
        $product->shop_id = $request->shop_id;
        $product->name = $request->name;
        $product->slug = $slug;
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->special_price = $request->special_price;
        $product->unit_id = $request->unit_id;
        $product->weight = $request->weight;
        $product->description = $request->description;
        $product->img = $request->img;
        $product->save();

        foreach($request->category as $category){
            $categoryRelation = new CategoryProductRelation();
            $categoryRelation->product_id = $product->id;
            $categoryRelation->category_id = $category;
            $categoryRelation->save();
        }

        return redirect(route('frontproducts.own-products'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        $data['product'] = $product;
        $data['comments'] = Comment::where('type',2)->where('type_id', $id)->where('active', 1)->get();
        if($product->active == 1){
            return view('front.products.show', $data);
        }else{
            return redirect(route('home'));
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $data['shops'] = Shop::where('owner_id', Auth::user()->id)->where('active',1)->get();
        $data['product'] = $product;
        if($product->shop->owner_id == Auth::user()->id || Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Moderator') && $product->active == 1){
            return view('front.products.edit', $data);
        }else{
            return redirect(route('home'));
        } 
    }

    public function update(Request $request, $id)
    {
        $shop = Shop::find($request->shop_id);
        if($shop->owner_id !== Auth::user()->id){
            return redirect(route('home'));
        }

        $request->validate([
            'shop_id' => 'required|numeric',
            'name' => 'required|max:50',
            'price' => 'required|numeric',
            'description' => 'required',
            'qty' => 'required|numeric',
            'img' => 'required'
        ]);

        $slug = Str::slug($request->name, '-');

        Product::where('id', $id)
                ->update([
                        'shop_id' => $request->shop_id,
                        'name' => $request->name,
                        'slug' => $slug,
                        'qty' => $request->qty,
                        'price' => $request->price,
                        'special_price' => $request->special_price,
                        'unit_id' => $request->unit_id,
                        'weight' => $request->weight,
                        'description' => $request->description,
                        'img' => $request->img
                        ]);
        return redirect( route('frontproducts.own-products') );
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if($product->shop->owner_id == Auth::user()->id && $product->active == 1){
            Product::where('id', $id)->update(['active' => 0]);
            $relations = CategoryProductRelation::where('product_id', $id)->get();
            foreach($relations as $relation){
                $relation->delete();
            }
            return redirect( route('frontproducts.own-products') );
        }else{
            return redirect(route('home'));   
        }
        
    }

    public function ownProducts()
    {
        $userShopsIds = [];
        $userShops = Shop::where('owner_id', Auth::user()->id)->get();
        foreach($userShops as $userShop){
            $userShopsIds[] = $userShop->id;  
        }
        $data['products'] = Product::whereIn('shop_id', $userShopsIds)->where('active',1)->get();
        return view('front.products.ownproducts', $data);
    }
}
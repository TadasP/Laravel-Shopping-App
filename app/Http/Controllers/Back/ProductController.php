<?php

namespace App\Http\Controllers\Back;

use App\Product;
use App\Category;
use App\Shop;
use App\CategoryProductRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    
    public function index()
    {
        $data['products'] = Product::paginate(8);
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.products.list', $data);
        }else{
            return redirect(route('home'));
        }
    }

    public function create()
    {
        $data['shops'] = Shop::all();
        $categories = new CategoryController();
        $data['categories'] = $categories->getProductCategoryTree();
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.products.create', $data);
        }else{
            return redirect(route('home'));
        }
    }

    public function store(Request $request)
    {
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

        return redirect(route('products.index'));
    }

    public function show($id)
    {
        $data['product'] = Product::find($id);
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.products.show', $data);
        }else{
            return redirect(route('home'));
        }    
    }

    public function edit($id)
    {
        $data['shops'] = Shop::all();
        $data['product'] = Product::find($id);
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.products.edit', $data);
        }else{
            return redirect(route('home'));
        }  
    }

    public function update(Request $request, $id)
    {
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
        return redirect( route('products.index') );
    }

    public function destroy($id)
    {
        Product::where('id', $id)->update(['active' => 0]);
        $relations = CategoryProductRelation::where('product_id', $id)->get();
        foreach($relations as $relation){
            $relation->delete();
        }
        return redirect( route('products.index') );
    }
}
<?php

namespace App\Http\Controllers;

use App\User;
use App\CategoryProductRelation;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Back\CategoryController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin');
        }
        else{
            $categories = new CategoryController();
            $data['categories'] = $categories->getFrontProductCategoryTree();
            $productIds = Product::where('active', 1)->paginate(6);
            $data['productsIds'] =  $productIds;
            return view('front.home', $data);
        }
    }
}

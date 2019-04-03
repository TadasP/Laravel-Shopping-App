<?php

namespace App\Http\Controllers\Back;

use App\Category;
use App\CategoryProductRelation;
use App\Product;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    
    public function index()
    {
        return redirect( route('home'));
    }

    public function create()
    {
        $data['parent_categories'] = Category::where('active',1)->get();
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.categories.create', $data);
        }else{
            return redirect( route('home'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'parent_id' => 'required|numeric',
            'type' => 'required|numeric'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $slug = Str::slug($request->name, '-');
        $category->slug = $slug;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->typeId = $request->type;
        $category->save();

        if($request->type == 0){
            return redirect(route('categories.product-categories')); 
        }else{
            return redirect(route('categories.post-categories'));
        }
    }

    public function show($id)
    {
        $data['category'] = Category::find($id);
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.categories.show', $data);
        }else{
            return redirect( route('home')); 
        }    
    }

    public function edit($id)
    {
        $data['parent_categories'] = Category::where('parent_id',0)->get();
        $data['category'] = Category::find($id);
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.categories.edit', $data); 
        }else{
            return redirect( route('home')); 
        }  
    }

    public function update(Request $request, $id)
    {
        $slug = Str::slug($request->name, '-');
       
        Category::where('id', $id)
                ->update([
                        'name' => $request->name,
                        'slug' => $slug,
                        'description' => $request->description,
                        'parent_id' => $request->parent_id
                        ]);

        if($request->type == 0){
            return redirect(route('categories.product-categories')); 
        }else{
            return redirect(route('categories.post-categories'));
        }
    }

    public function destroy($id)
    {
        Category::where('id', $id)->update(['active' => 0]);
        $category = Category::find($id);

        if($category->typeId == 0){
            return redirect(route('categories.product-categories')); 
        }else{
            return redirect(route('categories.post-categories'));
        }
    }

    private function cleanData($items) 
    {

        $data = array();
    
        foreach($items as $item){
            $data[$item->parent_id][] = ['id'=>$item->id,'name'=>$item->name, 'parent_id'=>$item->parent_id];
        }        
        return $data;
    }

    private function constructTree($data, $current)
    {
        if ($current != 0){
            $string = '<ul class="nested">';
        } else {
            $string = '<ul>';
        }
        foreach ($data[$current] as $element) {
            if (!key_exists($element['id'],$data)){
                $string .= '<li><input type="checkbox" name="category[]" value="'.$element['id'].'">'.$element['name'].'</li>';
            } else {
                $string .='<li><input type="checkbox" name="category[]" value="'.$element['id'].'"><span class="customcaret">'.$element['name'].'</span>';
                $string .= $this->constructTree($data, $element['id']);
                $string .='</li>';
            }
        }
        $string .='</ul>';
        return $string;
    }
    
    
    private function constructFrontTree($data, $current)
    {
        if ($current != 0){
            $string = '<ul class="nav navbar-nav">';
        } else {
            $string = '<ul class="nav navbar-nav" style="width:100%;">';
        }
        
        foreach ($data[$current] as $element) {
            if (!key_exists($element['id'],$data)){
                $route =  route('home.products', $element['id']);
                $string .= 
                '<li class="nav-item bg-light pl-2">
                    <a class="nav-link" href="'.$route.'" style="color:black">'.$element['name'].'</a>
                </li>';
            } else {
                $string .='<li class="nav-item bg-light pl-2">
                <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#dropdown-lvl'.$element['id'].'" style="color:black">'.$element['name'].'</a>
                <div id="dropdown-lvl'.$element['id'].'" class="panel-collapse collapse">'
                ;
                $string .= $this->constructFrontTree($data, $element['id']);
                $string .='</div></li>';
            }
        }
        $string .='</ul>';
        return $string;    
    }
    
    public function getProductCategoryTree()
    {
        $rawData =  DB::table('categories')->where('typeId',0)->get();
        if ($rawData->count()>0){
            $tree = $this->cleanData($rawData);
            $list = $this->constructTree($tree,0);
            return $list;
        } else {
            return null;
        }
    }

    public function getPostCategoryTree()
    {
        $rawData =  DB::table('categories')->where('typeId',1)->get();
        if ($rawData->count()>0){
            $tree = $this->cleanData($rawData);
            $list = $this->constructTree($tree,0);
            return $list;
        } else {
            return null;
        }
    }

    public function getFrontProductCategoryTree()
    {
        $rawData =  DB::table('categories')->where('typeId',0)->get();
        if ($rawData->count()>0){
            $tree = $this->cleanData($rawData);
            $list = $this->constructFrontTree($tree,0);
            return $list;
        } else {
            return null;
        }
    }

    public function productCategories()
    {
        $data['categories'] = Category::where('typeId',0)->get();
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.categories.product-list', $data);
        }else{
            return redirect( route('home'));    
        }
    }

    public function postCategories()
    {
        $data['categories'] = Category::where('typeId',1)->get();
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.categories.post-list', $data);
        }else{
            return redirect( route('home'));    
        }
    }

    public function showFrontProducts($id)
    {
        $products = [];
        $productIds = CategoryProductRelation::where('category_id', $id)->paginate(6);
        $data['productsIds'] =  $productIds;
        $data['categories'] = CategoryController::getFrontProductCategoryTree();
        return view('front.home', $data);
    }

    public function showPosts($id)
    {
        $data['posts'] = Post::where('category_id', $id)->where('active', 1)->get();
        return view('front.posts.post-list', $data);
    }
}
<?php

namespace App\Http\Controllers\Back;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    
    public function index()
    {
        $data['posts'] = Post::paginate(8);
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.posts.list', $data);
        }else{
            return redirect(route('home'));
        }
    }

    public function create()
    {
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.posts.create');
        }else{
            return redirect(route('home'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required|numeric',
            'type' => 'required|numeric'
        ]);

        $slug = Str::slug($request->title, '-');

        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->slug = $slug;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->save();

        return redirect(route('posts.index'));
    }

    public function show($id)
    {
        return redirect( route('home'));
    }

    public function edit($id)
    {
        return redirect( route('home'));
    }

    public function update(Request $request, $id)
    {
        return redirect( route('home'));
    }

    public function destroy($id)
    {
        return redirect( route('home'));
    }
}

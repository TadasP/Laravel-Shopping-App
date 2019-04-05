<?php

namespace App\Http\Controllers\Back;

use App\Post;
use App\Category;
use App\User;
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
        $data['posts'] = Post::All();
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
        $data['categories'] = Category::where('typeId',1)->where('active',1)->get();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.posts.create', $data);
        }else{
            return redirect(route('home'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required'
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
        $post = Post::find($id);
        $data['post'] = $post;
        $data['author'] = User::find($post->user_id);

        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.posts.show', $data);
        }else{
            return redirect(route('home'));
        } 
    }

    public function edit($id)
    {
        $data['post'] = Post::find($id);
        $user = Auth::user();

        if($user->hasRole('Super Admin') || $user->hasRole('Admin')){
            return view('admin.posts.edit', $data);
        }else{
            return redirect(route('home'));
        }  
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $slug = Str::slug($request->name, '-');

        Post::where('id', $id)
                ->update([
                        'title' => $request->title,
                        'content' => $request->content
                        ]);
        return redirect( route('posts.index') );
    }

    public function destroy($id)
    {
        Post::where('id', $id)->update(['active' => 0]);
        return redirect( route('posts.index') );
    }
}

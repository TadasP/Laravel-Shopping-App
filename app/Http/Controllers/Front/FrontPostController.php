<?php

namespace App\Http\Controllers\Front;

use App\Post;
use App\Category;
use App\CategoryProductRelation;
use App\User;
use App\Contact;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Back\CategoryController;

class FrontPostController extends Controller
{
    
    public function index()
    {
        $data['categories'] = Category::where('typeId',1)->where('active', 1)->get();
        return view('front.posts.list', $data);
    }

    public function create()
    {
        $categories = new CategoryController();
        $data['categories'] = Category::where('typeId',1)->where('active',1)->get();
        return view('front.posts.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        $post= new Post();

        $slug = Str::slug($request->title, '-');
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->slug = $slug;
        $post->content = $request->content;
        $post->category_id = base64_decode($request->category_id);
        $post->save();

        return redirect(route('frontposts.own-posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);
        $data['author'] = User::where('id', $post->user_id)->first();
        $data['post'] = $post;

        $postAmount = 0;
        $posts = Post::where('user_id', $post->user_id)->where('active',1)->get();
        foreach($posts as $post){
            $postAmount++;
        }

        $data['posts'] = $postAmount;

        $data['comments'] = Comment::where('type',1)->where('type_id', $id)->where('active', 1)->get();

        return view('front.posts.show', $data);
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $data['post'] = $post;
        if($post->user_id == Auth::user()->id || Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Moderator') && $post->active == 1 ){
            return view('front.posts.edit', $data);
        }else{
            return redirect(route('home'));
        } 
        
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if($request->title !== $post->title){
            $request->validate([
                'title' => 'required|unique:posts|max:255',
            ]);
        }

        $request->validate([
            'content' => 'required'
        ]);

        $slug = Str::slug($request->title, '-');

        Post::where('id', $id)
                ->update([
                        'title' => $request->title,
                        'slug' => $slug,
                        'content' => $request->content
                        ]);
        return redirect( route('frontposts.own-posts') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id', $id)->update(['active' => 0]);
        return redirect( route('frontposts.own-posts') );
    }

    public function ownPosts()
    {
        $data['posts'] = Post::where('user_id', Auth::user()->id)->where('active',1)->get();
        return view('front.posts.ownposts', $data);
    }
}

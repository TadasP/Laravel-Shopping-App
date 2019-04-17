<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {
        return redirect(route('home'));
    }

    public function create()
    {
        return redirect( route('home') );
    }

    public function store(Request $request)
    {
        $type = base64_decode($request->type);
        $type_id = base64_decode($request->type_id);
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->type = $type;
        $comment->type_id = $type_id;
        $comment->content = $request->content;
        $comment->save();

        if($type == 1){
            return redirect(route('frontposts.show', $type_id));
        }elseif($type == 2){
            return redirect(route('frontproducts.show', $type_id));
        }
        
    }

    public function show($id)
    {
        return redirect( route('home') );
    }

    public function edit($id)
    {
        return redirect( route('home') );
    }

    public function update(Request $request, $id)
    {
        return redirect( route('home') );
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        Comment::where('id', $id)->update(['active' => 0]);

        if($comment->type == 1){
            return redirect(route('frontposts.show', $comment->type_id));
        }elseif($comment->type == 2){
            return redirect(route('frontproducts.show', $comment->type_id));
        }
    }
    
    public function editForm(Request $request)
    {
        $commentId = $request->id;
        $comment = Comment::find($commentId);

        $data['comment'] = $comment;
        
        return response( view('front.products.editForm', $data));
    }  

    public function forumEditForm(Request $request)
    {
        $commentId = $request->id;
        $comment = Comment::find($commentId);

        $data['comment'] = $comment;
        
        return response( view('front.posts.editForm', $data));
    }

    public function updateReview(Request $request)
    {
        $commentId = base64_decode($request->id);
        $comment = Comment::find($commentId);
        
        Comment::where('id', $commentId)
                ->update([
                        'content' => $request->content,
                        ]);

        return redirect(route('frontproducts.show', $comment->type_id));
    }

    public function updateComment(Request $request)
    {
        $commentId = base64_decode($request->id);
        $comment = Comment::find($commentId);
        
        Comment::where('id', $commentId)
                ->update([
                        'content' => $request->content,
                        ]);

        return redirect(route('frontposts.show', $comment->type_id));
    }
}

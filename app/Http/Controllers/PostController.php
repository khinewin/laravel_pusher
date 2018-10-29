<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\NewComment;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getWelcome(){
        $posts=Post::latest()->get();
        return view ('welcome')->with(['posts'=>$posts]);
    }
    public function getPost($post){
        $post=Post::Where('id', $post)->first();
        return view ('post')->with(['post'=>$post]);
    }
    public function postComment(Request $request){
        $comment_body=$request['comment_body'];
        $user_id=$request['user_id'];
        $post_id=$request['post_id'];

        $cmt=new Comment();
        $cmt->user_id=$user_id;
        $cmt->post_id=$post_id;
        $cmt->comment_body=$comment_body;
        $cmt->save();

        $comment=Comment::where('id', $cmt->id)->with('user')->first();

        event(new NewComment($comment));

        return response()->json($comment);
    }
    public function getComments($post){
        $cmts=Comment::where('post_id', $post)->with('user')->latest()->get();
        return response()->json($cmts);
    }
}

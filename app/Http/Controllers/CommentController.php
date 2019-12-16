<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Carbon\Carbon;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = Comment::whereDate('created_at', Carbon::now()->toDateString())
          ->where('article_id',$request["article_id"])
          ->where('user_id',$request["user_id"])
          ->get()->count();
        if($data<=5){
        Comment::create([
            "article_id"=>$request["article_id"],
            "comment"=>$request["comment"],
            "user_id"=>$request["user_id"]


         ]);
         return response()->json(['success',$data], 200); 
        }else{
            return response()->json(['error'=>'spam'], 401);   
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $article = Comment::findOrFail($request['id']);
        
        if($article->delete()){
            return response()->json(['success'], 200); 
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles= Article::where('user_id',$request['id'])->with('comments')->orderBy('created_at','desc')->get();
        if($articles[0]!==null){
        foreach($articles as $article){
            $article['creat_at']=$article['created_at']->format('l jS \\of F Y h:i:s A');
                
            }
            return $articles;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $article = Article::create([
            "title"=>$request["title"],
            "body"=>$request["body"],
            "user_id"=>$request["user_id"]

         ]);
         return response()->json(['success'], 200); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getArticle(Request $request)
    {
        $articles= Article::where('id',$request['id'])->with(['comments','comments.user'])->get();
        foreach($articles as $article){
            $article['creat_at']=$article['created_at']->format('l jS \\of F Y h:i:s A');
                
            }
            return $articles;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show()

    {
        $articles= Article::with(['comments','comments.user'])->orderBy('created_at','desc')->paginate(4);

        foreach($articles as $article){
        $article['creat_at']=$article['created_at']->format('l jS \\of F Y h:i:s A');
            
        }
        return $articles;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Article::where('id', $request['id'])->update(array(
            'title' 	  =>  $request['title'],
            'user_id' 	  =>  $request['user_id'],
            'body'        => $request['body'],
        )); 
        return response()->json(['success'], 200); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $article = Article::findOrFail($request['id']);
        
        if($article->delete()){
            return response()->json(['success'], 200); 
        }
    }
}

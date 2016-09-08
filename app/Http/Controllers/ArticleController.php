<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Article;
use App\Category;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request)
    {
    	$articles = Article::all();
    	$categories = Category::all();
        return view('article.index', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }

    public function show($id)
    {

        $article = Article::find($id);
        $article->category;
        if($article){
            return \Response::json($article);
        }
        else{
            $response = array(
                'status' => 'error',
                'msg' => 'Nothing to show',
            );
            return \Response::json($response);
        }
    }

    public function store(Request $request)
	{
	    // Проверка запроса...
	    $this->validate($request, [
                'name' => 'required|max:255',
                'text' => 'required',
	            'category' => 'required|numeric',
	        ]);

	    $article = new Article;

	    $article->name = $request->name;
	    $article->category_id = $request->category;
	    $article->text = $request->text;
	    $article->category_id = $request->category;

	    if($article->save()){
            return $article->toJson();
        }
        else{
            $response = array(
                'status' => 'error',
                'msg' => 'Article does not save',
            );
            return \Response::json($response);
        }
	}

    public function update(Request $request)
    {

        $this->validate($request, [
                'name' => 'required|max:255',
                'text' => 'required',
                'category' => 'required|numeric',
            ]);

        $article = Article::find($request->id);

        $article->name = $request->name;
        $article->category_id = $request->category;
        $article->text = $request->text;
        $article->category_id = $request->category;

        if($article->save()){
            return $article->toJson();
        }
        else{
            $response = array(
                'status' => 'error',
                'msg' => 'Article does not save',
            );
            return \Response::json($response);
        }
    }

	public function destroy(Request $request, $id)
    {
		$article = Article::destroy($id);

        if(!$article){
            $response = array(
                'status' => 'error',
                'msg' => 'Article does not save',
            );
            return \Response::json($response);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request)
    {
    	$categories = Category::all();
        return view('category.index', [
            'categories' => $categories,
        ]);
    }

    public function show($id)
    {

        $category = Category::find($id);
        $category->category;
        if($category){
            return \Response::json($category);
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
	        ]);

	    $category = new Category;

	    $category->name = $request->name;

	    if($category->save()){
            return $category->toJson();
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
            ]);

        $category = Category::find($request->id);

        $category->name = $request->name;

        if($category->save()){
            return $category->toJson();
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
		$category = Category::destroy($id);

        if(!$category){
            $response = array(
                'status' => 'error',
                'msg' => 'Cann`t delete this item',
            );
            return \Response::json($response);
        }
    }
}

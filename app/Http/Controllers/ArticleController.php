<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Apparently laravel can also get the models for us and automatically return a 404 when it can't find the article. Something I might use next time.

// Everybody can access all methods. No auth implemented
class ArticleController extends Controller
{
    public function index() {
    	return Response()->json(\App\Article::with('category:id,title')->orderBy('created_at', 'desc')->get(), 200);
    }

    // create
    public function create(Request $request) {
		$result = \App\Article::create($request->all());
		return Response()->json($result, $result ? 201 : 400);
    }

    // read
    public function read(Request $request, $id) {
		$result = \App\Article::with('category:id,title')->find($id);
		return Response()->json($result, $result ? 200 : 404);
    }

    // update
    public function update(Request $request, $id) {
		($article = \App\Article::find($id)) && ($result = $article->update($request->all()));
		return Response()->json($article, $article ? ($result ? 200 : 400) : 404);
    }

    // delete
    public function delete(Request $request, $id) {
		($article = \App\Article::find($id)) && ($result = $article->delete());
		return Response()->json(null, $article ? ($result ? 204 : 400) : 404);
    }
}

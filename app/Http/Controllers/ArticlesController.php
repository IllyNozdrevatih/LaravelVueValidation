<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreArticle;
use App\Article;
use App\Category;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    public function index(){
        $articles = Article::all();
        return view('articles.index',compact('articles'));
    }

    public function show(Article $article){
        return view('articles.show',compact('article'));
    }

    public function create(){
        $categories = Category::all();
        return view('articles.create',compact('categories'));
    }

    public function store(StoreArticle $request){
        $user = Auth::user();
        return dd($request->image);
        $title = $request->title;
        $description = $request->description;
        $categories = $request->categories;
        $image = $request->file('image')->store('image','public');
        $article = new Article(compact('title','description','image'));
//        $article = new Article(compact('title','description'));
        $user->articles()->save($article);
        $article->categories()->attach($categories);
//        return ['massage' => $user->id];
//        die;
        return redirect()->route('articles.index');
    }

    public function edit(Article $article){
        return view('blogger.articles.edit',compact('article'));
    }

    public function update(StoreArticle $request, Article $article){
        $image = $request->file('image')->store('image','public');
        $article->categories()->detach();
        $article->update($request->except('_method','_token','categories'));
        $article->update(compact('image'));
        $article->categories()->attach($request->categories);
        return redirect()->route('articles.index');
    }

    public function destroy(Article $article){
        $article->categories()->detach();
        $article->delete();
        return redirect()->back();
    }
}

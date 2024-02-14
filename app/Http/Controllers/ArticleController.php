<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ArticleController extends Controller
{
    public function index(): View {

        $articles = Article::paginate(4);

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article): View {

        return view('articles.show', compact('article'));

    }
}

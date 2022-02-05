<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::query()->select(News::$availableFields)->get();

        return view('news.index', [
          'newsList' => $news
        ]);
    }

    public function show(News $news)
    {
        //Приходит пустой news
        return view('news.show', [
            'news' => $news
        ]);
    }
}

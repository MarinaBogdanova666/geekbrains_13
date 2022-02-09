<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\EditRequest;
use App\Models\Category;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::query()
            ->whereHas('category')
//            ->select(News::$availableFields)
            ->paginate(10);

        return view('admin.news.index', [
            'newsList' => $news
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.news.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {

        $rules = $request->rules();
        $created = News::create($request->validate($rules) + [
                'slug' => \Str::slug($request->input('title'))
            ]);

        if($created){
            return redirect()->route('admin.news.index')
                ->with('success', 'Запись успешно добавлена!');
        }

        return back()->with('error','Не удалось добавить запись')
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  News $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $categories = Category::all();

        return view('admin.news.edit', [
            'news' => $news,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditRequest $request
     * @param  News $news
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, News $news)
    {
        $rules = $request->rules();
        $updated = $news->fill($request->validate($rules) + [
            'slug' => \Str::slug($request->input('title'))
        ])->save();

        if($updated){
            return redirect()->route('admin.news.index')
                ->with('success', 'Запись успешно обновлена!');
        }

        return back()->with('error','Не удалось обновить запись')
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  News $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        try{
            $news->delete();
            return response()->json('ok');
        }catch(\Exception $e) {
            \Log::error("Error delete news item");
        }
    }
}

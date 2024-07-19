<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index1()
    {
        $news = News::all();
        $categories = Category::all();

        return view('index', compact('news', 'categories'));
    }
    public function index()
    {
        $news = News::with('category')->get();
        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $request->validated([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:news,slug',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|url',
            'status' => 'required|in:draft,published',
        ]);
        News::create($request->validated());
        return redirect()->route('news.index')->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $news = News::with('comments.user')->findOrFail($id);
        return view('client.show', compact('news'));
    }
    public function newsByCategory(Category $category)
    {
        $news = News::where('category_id', $category->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('client.category', compact('news', 'category'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $news = News::where('content', 'LIKE', "%{$query}%")
            ->orWhere('title', 'LIKE', "%{$query}%")
            ->latest()
            ->get();

         $category = Category::where('name', 'LIKE', "%{$query}%")
            ->get();

        return view('client.search', compact('news', 'category', 'query'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)

    {
        $categories = Category::all();
        return view('news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $request->validated([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:news,slug,' . $news->id,
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|url',
            'status' => 'required|in:draft,published',
        ]);
        $news->update($request->validated());
        return redirect()->route('news.index')->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')->with('success', 'xóa thành công');
    }




}

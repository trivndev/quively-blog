<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Blog::latest()->where('author_id', Auth::user()->id);
        if (request('keyword')) {
            $posts = $posts->where('title', 'like', '%' . request('keyword') . '%');
        }
        return view('dashboard.index', ['title' => 'dashboard', 'posts' => $posts->paginate(10)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create', ["title" => 'Create Blog']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'unique:blogs', 'min:12', 'max:100'],
            'category_id' => 'required',
            'blog_content' => ['required', 'min:100'],
        ]);

        Blog::create([
            'slug' => Str::slug($request->title),
            'title' => $request->title,
            'blog_content' => $request->blog_content,
            'author_id' => Auth::user()->id,
            'category_id' => $request->category_id,
        ]);

        return redirect('/dashboard')->with(['success' => 'Blog created successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $post)
    {
        return view('dashboard.show', ["title" => $post->title, "post" => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $post)
    {
        return view('dashboard.edit', ["title" => 'Edit Blog', "post" => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $post)
    {
        $request->validate([
            'title' => 'required|min:8|max:64|unique:blogs,title,' . $post->id,
            'category_id' => 'required',
            'blog_content' => ['required', 'min:100'],
        ]);

        $post->update([
            'slug' => Str::slug($request->title),
            'title' => $request->title,
            'blog_content' => $request->blog_content,
            'author_id' => Auth::user()->id,
            'category_id' => $request->category_id,
        ]);

        return redirect('/dashboard')->with(['success' => 'Blog updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $post)
    {
        $post->delete();
        return redirect('/dashboard')->with(['success' => 'Blog deleted successfully!']);
    }
}

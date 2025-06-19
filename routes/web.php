<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Models\Blog;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Blog::latest()->filter(request(['keyword', 'category', 'author']))->paginate(12)->withQueryString();
    return view('blogs', ['title' => 'Blog', 'posts' => $posts]);
});

Route::get('/blog', function () {
    $posts = Blog::latest()->filter(request(['keyword', 'category', 'author']))->paginate(12)->withQueryString();
    return view('blogs', ['title' => 'Blog', 'posts' => $posts]);
});

Route::get('/blog/{slug}', function ($slug) {
    $post = Blog::where('slug', $slug)->first();

    return view('blog', [
        'title' => $post->title ?? 'Article Not Found',
        'post' => $post
    ]);
});

Route::get(' /about', function () {
    return view('about', ['title' => 'About']);
});

Route::get(' /contact', function () {
    return view('contact', ['title' => 'Contact']);
});

Route::get('/dashboard', [BlogController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/dashboard', [BlogController::class, 'store'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/create', [BlogController::class, 'create'])->middleware(['auth', 'verified']);

Route::delete('/dashboard/{post:slug}', [BlogController::class, 'destroy'])->middleware(['auth', 'verified']);

Route::get('/dashboard/{post:slug}', [BlogController::class, 'show'])->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [BlogController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [BlogController::class, 'store']);
    Route::get('/dashboard/create', [BlogController::class, 'create']);
    Route::delete('/dashboard/{post:slug}', [BlogController::class, 'destroy']);
    Route::get('/dashboard/{post:slug}/edit', [BlogController::class, 'edit']);
    Route::patch('dashboard/{post:slug}', [BlogController::class, 'update']);
    Route::get('/dashboard/{post:slug}', [BlogController::class, 'show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/upload', [ProfileController::class, 'upload']);
});

require __DIR__ . '/auth.php';

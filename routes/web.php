<?php

use Illuminate\Support\Facades\Route;
use \App\Models\PostFIle;
use \Spatie\YamlFrontMatter\YamlFrontMatter;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NewsletterController;
use App\Services\Newsletter;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group wh ich
| contains the "web" middleware group. Now create something great!
|
*/

// Home

Route::get('/', [PostController::class, 'index'])->name('home');

// Post

Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

// Authentication

Route::get('login', [SessionController::class, 'create'])->middleware('guest');

Route::post('login', [SessionController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');

Route::post('register', [RegisterController::class, 'store'])->middleware('guest');


//Newsletter

Route::post('newsletter', NewsletterController::class);


// Admin

Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware('admin');

Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('admin');

Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->middleware('admin');

Route::post('admin/posts', [AdminPostController::class, 'store'])->middleware('admin');

Route::patch('admin/posts/{post}', [AdminPostController::class, 'update'])->middleware('admin');

Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->middleware('admin');
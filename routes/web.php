<?php

use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'homepage'])->name('homepage');
Route::post('/posts/{post}/comment', [PageController::class, 'comment'])->name('comment');
Route::get('/article/{article_id}', [PageController::class, 'article'])->name('article');
Route::get('/category/{tag_name}', [PageController::class, 'category'])->name('category');
Route::post('/posts/{post}/like', [PageController::class, 'like'])->name('like');
Route::post('/message', [PageController::class, 'message'])->name('message');

Route::get('redirect/{driver}', [LoginController::class, 'redirectToProvider'])
    ->name('login.provider')
    ->where('driver', implode('|', config('auth.socialite.drivers')));

Route::get('{driver}/callback', [LoginController::class, 'handleProviderCallback'])
    ->name('login.callback')
    ->where('driver', implode('|', config('auth.socialite.drivers')));

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::resource('/posts',  PostController::class);
    Route::put('/posts/{post}/publish', [PostController::class, 'publish'])->middleware('admin');
    Route::put('/posts/{post}/set-headline', [PostController::class, 'setHeadline'])->middleware('admin');
    Route::put('/posts/{post}/set-homepage-headline', [PostController::class, 'setHomepageHeadline'])->middleware('admin');
    Route::resource('/categories', CategoryController::class, ['except' => ['show']]);
    Route::resource('/tags', TagController::class, ['except' => ['show']]);
    Route::put('/tags/{tag}/set-for-work', [TagController::class, 'setForWork'])->middleware('admin');
    Route::put('/tags/{tag}/unset-for-work', [TagController::class, 'unsetForWork'])->middleware('admin');
    Route::resource('/comments', CommentController::class, ['only' => ['index', 'destroy']]);
    Route::resource('/messages', MessageController::class, ['only' => ['index', 'destroy']]);
    Route::resource('/users', UserController::class, ['middleware' => 'admin', 'only' => ['index', 'destroy']]);
});

Route::post('ckeditor/image_upload', [CKEditorController::class, 'upload'])->name('upload');

require __DIR__.'/auth.php';

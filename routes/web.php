<?php

use App\Models\Post;
use App\Models\Reply;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminPostsController;
use App\Http\Controllers\ReplyReplyController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardPostController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function(){
//     return view('welcome');
// });

//main routes
Route::get('/', function () {
    // $posts = Post::all();
    // $categories = Category::all();
    return view('home', [
        "title" => "Home",
        'active' => "home",
        // 'posts' => Post::latest()->take(5)->get(),
        // 'categories' => $categories
    ]);
});
Route::get('/about', [AboutController::class, 'index']);

Route::get('/posts', [PostController::class, 'index']);

Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::post('/posts/{post}/store', [CommentController::class, 'store']);

Route::post('/posts/{post}/comments/{comment}/replies', [ReplyController::class, 'store']);

Route::post('/posts/{post:slug}/comments/{comment}/replies/{reply}/replies', [ReplyReplyController::class, 'store']);

Route::delete('/comment/{comment}/{slug}', [CommentController::class, 'destroy'])->name('comment.destroy');

Route::delete('/reply/{reply}/{slug}', [ReplyController::class, 'destroy'])->name('reply.destroy');

Route::get('/categories/{category:slug}', [CategoryController::class, 'index']);

Route::get('/categories', [CategoryController::class, 'showAll']);

Route::get('/authors/{author:username}', [AuthorController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
//end main routes


//dashboard user
Route::get('/dashboard', function(){
    return view('dashboard.index', [
        'count' => Post::where('user_id', auth()->id())->count()
    ]);
})->middleware('auth');

Route::get('/dashboard/posts/slug', [DashboardPostController::class, 'slug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');
//end dashboard 

//admin section
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');
Route::get('/dashboard/manageposts/slug', [AdminPostController::class, 'slug'])->middleware('admin');
Route::resource('/dashboard/manageposts', AdminPostsController::class)->middleware('admin');
//end admin section

//like
// Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('likes.store');
Route::post('/posts/{post}/likes', [LikeController::class, 'toggle'])->name('likes.toggle')->middleware('auth');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('likes.destroy');
//endlike
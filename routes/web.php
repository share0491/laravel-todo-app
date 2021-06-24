<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\PostController;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Facades\File;


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

Route::get('/', [PostController::class, 'index'])->name('home');

// Route::get('posts/{post:slug}', function (Post $post) {
//     //Post::where('slug', $post)->firstOrFail();

//     return view('post', [
//         'post' => $post
//     ]);

// });

Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('categories/{category:slug}', function (Category $category) {

    return view('posts', [
        'posts' => $category->posts,
        'categories' => Category::all(),
        'currentCategory' => $category
    ]);
})->name('category');

Route::get('authors/{author:username}', function(User $author){

    return view('posts', [
        'posts' => $author->posts
    ]);

});


Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/dashboard',[TasksController::class, 'index'])->name('dashboard');

    Route::get('/task',[TasksController::class, 'add']);
    Route::post('/task',[TasksController::class, 'create']);

    Route::get('/task/{task}', [TasksController::class, 'edit']);
    Route::post('/task/{task}', [TasksController::class, 'update']);
});
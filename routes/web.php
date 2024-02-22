<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MyBlogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\Inertia\ApiTokenController;

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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'redirect_admin',

])->group(function () {
    Route::get('users/export/', [DashboardController::class, 'export'])->name('users.export');
// Route::get('/user/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');
Route::get('/dashboard/users', [DashboardController::class, 'users'])->name('dashboard.users');
Route::get('/profile/{id}', [DashboardController::class, 'show'])->name('profile.user');
Route::get('/dashboard/blogs', [DashboardController::class, 'blogs'])->name('dashboard.blogs');
Route::get('/dashboard/comments', [DashboardController::class, 'comments'])->name('dashboard.comments');
Route::delete('/dashboard/destroy/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
Route::get('/dashboard', [DashboardController::class, 'users'])->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'redirect_membre',

])->group(function () {
    Route::get('/profile/{id}', [DashboardController::class, 'show'])->name('profile.user')->middleware('redirect_profile');
    Route::get('/user/search/',[UserController::class,'searchpage'])->name('user.searchpage');
    Route::get('/user/search/someone',[UserController::class,'search'])->name('user.search');
    Route::get('/user/{following_id}/folow',[UserController::class,'follow'])->name('user.follow');
    Route::get('/user/{following_id}/unfolow',[UserController::class,'unfollow'])->name('user.unfollow');
    Route::get('/', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/myblogs/filter', [MyBlogController::class, 'filter'])->name('myblogs.filter');
    Route::get('/myblogs/search', [MyBlogController::class, 'search'])->name('myblogs.search');
    Route::get('/myblogs/publish/{id}', [MyBlogController::class, 'publish'])->name('myblogs.publish');
    Route::get('/blogs/filter', [BlogController::class, 'filter'])->name('blogs.filter');
    Route::get('/blogs/downoload/{blog}', [BlogController::class, 'download'])->name('blogs.pdf');
    Route::get('/blogs/search', [BlogController::class, 'search'])->name('blogs.search');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::resource('/blogs', BlogController::class);
    Route::resource('/myblogs', MyBlogController::class);

});

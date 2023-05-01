<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Task;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| User Login Routes
|--------------------------------------------------------------------------
|
| Needs to run => npm run dev
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/admin/user/roles', [ 'middleware'=>'role' , function () {
    return "Middleware role";
}]);

Route::get('/admin', [AdminController::class, 'index']);

Route::get('/tasks', [App\Http\Controllers\TasksController::class, 'index']);

Route::get('/tasks/{task}', [App\Http\Controllers\TasksController::class, 'show']);

/*
|--------------------------------------------------------------------------
| Posts Routes
|--------------------------------------------------------------------------
|
| Creating a blog with the course
*/

Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('home');

Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create']);

Route::get('/posts/{post}', [App\Http\Controllers\PostController::class, 'show']);

Route::post('/posts', [App\Http\Controllers\PostController::class, 'store']);

Route::post('/posts/{post}/comments', [App\Http\Controllers\CommentsController::class, 'store']);

Route::get('/register', [App\Http\Controllers\RegistrationController::class, 'create']);

Route::post('/register', [App\Http\Controllers\RegistrationController::class, 'store']);

Route::get('/login', [App\Http\Controllers\SessionsController::class, 'create']);

Route::post('/login', [App\Http\Controllers\SessionsController::class, 'store']);

Route::get('/logout', [App\Http\Controllers\SessionsController::class, 'destroy']);

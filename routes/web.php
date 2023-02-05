<?php

use App\Http\Controllers\todoController;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', function () {
  $posts = Http::get('https://jsonplaceholder.typicode.com/posts');
    $posts = $posts->object();
 return view('welcome', compact('posts'));
});

//passing data on body with retry
//$response = Http::retry(3, 100, function ($exception) {
//    return $exception instanceof ConnectionException;
//})->post('https://jsonplaceholder.typicode.com/posts', [
//    'name' => 'my post',
//    'title' => 'Sample post title',
//    'description' => 'Description'
//]);

//pass params with timeout
//$response = Http::timeout(3)->get('https://jsonplaceholder.typicode.com/posts', [
//    'id' => 1,
//]);

//1//encode form url data
//$response = Http::asForm()->post('https://jsonplaceholder.typicode.com/posts', [
//    'name' => 'my post',
//    'title' => 'Sample post title',
//    'description' => 'Description'
//]);


Route::middleware('auth')->group(function () {
    Route::resource('home', todoController::class);
});

Route::get('create', function(){
    return view('create-todo');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

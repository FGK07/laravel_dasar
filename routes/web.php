<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gha', function(){
    return "Kuncoro Ganteng";
});

Route::redirect('/github', 'gha');

// fallaback
Route::fallback(function(){
    return "404 by Kuncoro Ganteng";
});

// pakai view
Route::view('/hello', 'hello', ['name' => 'Ferdian']);

// function closure
Route::get('/hello-again', function (){
    return view('hello', ['name'=>'Kuncoro']);
});

// nested view
Route::view('/hello-world', 'hello.world', ['name' => 'Kuncoro']);

Route::get('/hello-world-again', function (){
    return view('hello.world', ['name'=>'Egha']);
});

// route parameter
Route::get('/products/{id}', function($productId){
    return "Product $productId";
})->name('product.detail');

Route::get('/products/{id}/items/{item}', function($productId, $itemId){
    return "Product $productId, Item $itemId";
})->name('product.item.detail');


// route reguler expression constraint
Route::get('/categories/{id}', function($categoryId){
    return "Category : $categoryId";
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function($userId = '404'){
    return "User $userId";
})->name('user.detail');

// route conflict
// laravel ekseskusi dari atas ke bawah
Route::get('/conflict/kuncoro', function(){
    return "Conflict Ferdian Egha Kuncoro";
});

Route::get('/conflict/{name}', function($name){
    return "Conflict $name";
});

Route::get('/produk/{id}', function($id){
    $link = route('product.detail', ['id'=>$id]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function($id){
    return redirect()->route('product.detail', ['id' => $id]);
});

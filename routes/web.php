<?php

use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\URL;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gha', function(){
    return "Kuncoro Ganteng";
});

Route::redirect('/github', 'gha');

// fallback
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

// controller
Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);

Route::get('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello/first', [\App\Http\Controllers\InputController::class, 'helloFirstName']);
Route::post('/input/hello/input', [\App\Http\Controllers\InputController::class, 'helloInput']);
Route::post('/input/hello/array', [\App\Http\Controllers\InputController::class, 'helloArray']);

Route::post('/input/controller', [\App\Http\Controllers\InputController::class, "inputControllerParam"]);
Route::post('/input/type', [\App\Http\Controllers\InputController::class, "inputType"]);
Route::post('/input/filter/only', [\App\Http\Controllers\InputController::class, "filterOnly"]);
Route::post('/input/filter/except', [\App\Http\Controllers\InputController::class, "filterExcept"]);
Route::post('/input/filter/merge', [\App\Http\Controllers\InputController::class, "filterMerge"]);

// file upload
Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload'])
->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class]);//exclude middleware

// response
Route::get('/response/hello', [\App\Http\Controllers\ResponseController::class, 'response']);
Route::get('/response/header', [\App\Http\Controllers\ResponseController::class, 'header']);

// response type dengan route group
Route::prefix('/response')->group(function(){
    Route::get('/type/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
    Route::get('/type/json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
    Route::get('/type/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
    Route::get('/type/download', [\App\Http\Controllers\ResponseController::class, 'responseDownload']);

});

// cookie, pakai route controller
Route::controller(\App\Http\Controllers\CookieController::class)->group(function () {
    Route::get('/cookie/set', 'createCookie');
    Route::get('/cookie/get', 'getCookie');
    Route::get('/cookie/clear', 'clearCookie');

});

// redirect
Route::get('/redirect/from', [App\Http\Controllers\RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [App\Http\Controllers\RedirectController::class, 'redirectTo']);

// redirect name
Route::get('/redirect/name', [\App\Http\Controllers\RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [\App\Http\Controllers\RedirectController::class, 'redirectHello'])->name('redirect-hello');

// url generation named route
Route::get('/redirect/named', function () {
    // return route('redirect-hello', ['name' => 'egha']); // bisa
    // return url()->route('redirect-hello', ['name' => 'egha']); // bisa
    return URL::route('redirect-hello', ['name' => 'egha']); // bisa
});

Route::get('/redirect/action', [\App\Http\Controllers\RedirectController::class, 'redirectAction']);
Route::get('/redirect/away', [\App\Http\Controllers\RedirectController::class, 'redirectAway']);

// middleware
// Route::get('/middleware/api', function (){
    //     return "OK";
    // })->middleware([App\Http\Middleware\ContohMiddleware::class]);//cara biasa

//  kirim parameter kalau di grup middleware, pakai route middleware, multiple route group
Route::middleware(['contoh:FGK07, 401'])->prefix('/middleware')->controller(\App\Http\Middleware\ContohMiddleware::class)->group(function () {
    Route::get('/group', function (){
        return "GROUP";
    });
    Route::get('/api', function (){
        return "OK";
    });//pakai alias 
    
});

// csrf
Route::get('/form', [\App\Http\Controllers\FormController::class, 'form']);
Route::post('/form', [\App\Http\Controllers\FormController::class, 'submitForm']);

// url generation
Route::get('/url/current', function (){
    return URL::full();
});

// url action
Route::get('/url/action', function (){
    // return action([\App\Http\Controllers\FormController::class, 'form']); // bisa
    // return url()->action([\App\Http\Controllers\FormController::class, 'form']); // bisa
    return URL::action([\App\Http\Controllers\FormController::class, 'form']); // bisa
});

// session
Route::get('/session/create', [\App\Http\Controllers\SessionController::class, 'createSession']);
Route::get('/session/get', [\App\Http\Controllers\SessionController::class, 'getSession']);

// error exception
// Route::get('/error/sample', function (){
//     throw new Exception("Sample Error");
// });

Route::get('/error/sample', function (){
    report(new Exception("Sample Error"));
    return "OK";
});

Route::get('/error/validation', function (){
    throw new \App\Exceptions\ValidationException("Bad Request");
});

Route::get('/abort/400', function (){
    abort(400, "Ups Validation Error");
});

Route::get('/abort/401', function (){
    abort(401);
});

Route::get('/abort/500', function (){
    abort(500);
});

<?php

use App\Http\Controllers\NewsController;
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

// Route::get('/', function () {
//     return view('index');
// });
Route::resource('news', NewsController::class);
Route::get('/', [NewsController::class, 'index1'])->name('index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('client.show');
Route::get('/news/search', [NewsController::class, 'search'])->name('search');
Route::get('/categories/{category}', [NewsController::class, 'newsByCategory'])->name('category');

// Route::get('/', function () {
//     return view('shop');
// });
// Route::get('/', function () {
//     return view('about');
// });
Route::get('/test', function() {
    return 'Route hoạt động';
});

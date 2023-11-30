<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CategoryController;


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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard', compact('users'));

    })->name('dashboard');
});

// Route::get('/category', function () {
//     return view('admin.category.category');
// })->name('AllCat');


//Category routes
Route::get('/all/categories', [CategoryController::class, 'index'])->name('AllCat');

Route::post('/categories/store', [CategoryController::class, 'store'])->name('category.store');

// Add this to your web.php file
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

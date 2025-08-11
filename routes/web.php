<?php

use App\Livewire\Department\DepartmentController as DepartmentPage;
use App\Livewire\Kategori\KategoriController as KategoriPage;
use App\Livewire\Units\UnitsController as UnitsPage;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home\HomeController as HomePage;
use App\Livewire\Product\ProductController as ProductPage;
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
//     return view('home');
// });
Route::get('/', HomePage::class)->name('homepage');
Route::get('/product', ProductPage::class)->name('productpage');


Route::prefix('departments')->group(function () {
    Route::get('/', DepartmentPage::class)->name('departments.index');
    Route::get('/{id}', [DepartmentPage::class, 'show'])->name('departments.show');
    Route::post('/', [DepartmentPage::class, 'crudJson'])->name('departments.crud');
    Route::get('/download', [DepartmentPage::class, 'exportDepartments'])->name('departments.download');
});

Route::prefix('kategori')->group(function () {
    Route::get('/', KategoriPage::class)->name('kategori.index');
    Route::get('/{id}', [KategoriPage::class, 'show'])->name('kategori.show');
    Route::post('/', [KategoriPage::class, 'crudJson'])->name('kategori.crud');
});

Route::prefix('units')->group(function () {
    Route::get('/', UnitsPage::class)->name('unit.index');
    Route::get('/{id}', [UnitsPage::class, 'show'])->name('unit.show');
    Route::post('/', [UnitsPage::class, 'crudJson'])->name('unit.crud');
});

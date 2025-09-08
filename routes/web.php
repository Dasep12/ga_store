<?php

use App\Livewire\Department\DepartmentController as DepartmentPage;
use App\Livewire\Kategori\KategoriController as KategoriPage;
use App\Livewire\Units\UnitsController as UnitsPage;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home\HomeController as HomePage;
use App\Livewire\Barang\BarangController as ProductPage;
use App\Livewire\FrontEnd\MainController as MainPage;
use App\Livewire\FrontEnd\ShippingController as ShippingPage;
use App\Livewire\FrontEnd\TrackController as TrackPage;
use App\Livewire\FrontEnd\CheckoutController as CheckoutPage;
use App\Livewire\InputStock\InputStockController as InputStockPage;
use App\Livewire\Pengadaan\PengadaanController as PengadaanPage;
use App\Livewire\Stock\StockController as StockPage;
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
Route::get('/home', HomePage::class)->name('homepage');


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


Route::prefix('product')->group(function () {
    Route::get('/', ProductPage::class)->name('barang.index');
    Route::get('/{id}', [ProductPage::class, 'show'])->name('barang.show');
    Route::post('/', [ProductPage::class, 'crudJson'])->name('barang.crud');
    Route::post('/importExcel', [ProductPage::class, 'ImportExcel'])->name('barang.import');
    Route::get('/import/progress/{id}', [ProductPage::class, 'progress'])->name('barang.import.progress');
});

Route::prefix('pengadaan')->group(function () {
    Route::get('/', PengadaanPage::class)->name('pengadaan.index');
    Route::get('/{id}', [PengadaanPage::class, 'show'])->name('pengadaan.show');
    Route::post('/', [PengadaanPage::class, 'crudJson'])->name('pengadaan.crud');
    Route::post('/importExcel', [ProductPage::class, 'ImportExcel'])->name('pengadaan.import');
});

Route::prefix('inputstock')->group(function () {
    Route::get('/', InputStockPage::class)->name('inputstock.index');
    Route::get('/{id}', [InputStockPage::class, 'show'])->name('inputstock.show');
    Route::post('/crudJson', [InputStockPage::class, 'crudJson'])->name('inputstock.crud');
    Route::post('/importExcel', [InputStockPage::class, 'ImportExcel'])->name('inputstock.import');
    Route::get('/import/progress/{id}', [InputStockPage::class, 'progress'])->name('inputstock.import.progress');
});

Route::prefix('stock')->group(function () {
    Route::get('/', StockPage::class)->name('stock.index');
    Route::get('/{id}', [StockPage::class, 'show'])->name('stock.show');
});




Route::prefix('/')->group(function () {
    Route::get('/', MainPage::class)->name('main.index');
    Route::get('/shipping', ShippingPage::class)->name('main.shipping');
    Route::get('/track', TrackPage::class)->name('main.track');
    Route::get('/checkout', CheckoutPage::class)->name('main.checkout');
});

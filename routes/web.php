<?php

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Exports\PenerimaTemplateExport;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfografisController;

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

Route::get('/', [HomeController::class, 'index'])->name('beranda');

Route::get('/rekakarsacipta', [HomeController::class, 'rekakarsacipta'])->name('rkc');

Route::get('/kajian', [HomeController::class, 'kajian'])->name('kajian');

Route::get('/kajian/{slug}', [HomeController::class, 'kajian_show'])->name('kajian.show');

Route::get('/infografis', [HomeController::class, 'infografis'])->name('infografis');

Route::get('/infografis/{slug}', [HomeController::class, 'infografis_show'])->name('infografis.show');

Route::get('/template/penerima', function () {
    return Excel::download(new PenerimaTemplateExport, 'template_penerima.xlsx');
})->name('template.penerima');
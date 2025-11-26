<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Pdfcontroller;
use App\Http\Controllers\Clientescontroller;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/about', fn () => Inertia::render('About'))->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::get('/pdf', [Pdfcontroller::class, 'generatePdf']);
Route::get('/contrato/{ruc}', [PdfController::class, 'contratoPdf']);
Route::get('/cotizacion/{param2}', [PdfController::class, 'cotizacionPdf']);
Route::get('/cotizacionx/{param2}', [PdfController::class, 'cotizacionPdfx']);
Route::get('/reporte-combinado/{param2}', [PdfController::class, 'reporteCombinadoPdf']);

Route::get('/reportes', function () {
    return Inertia::render('reportes/reportes'); // Si está en /resources/js/Pages/Reportes/Reportes.vue
})->name('reportes');


Route::get('clientes/por-facturar', [Clientescontroller::class, 'clientesxfacturar'])->name('api.clientes.por-facturar');

Route::get('/clientes', function () {
    return Inertia::render('clientes/clientes'); // Nota: respeta la estructura de carpetas y el nombre del archivo (sin extensión)
})->name('clientes');



// Ruta para la API (consulta a la base de datos)
Route::get('/api/clientes/osxperiodo', [ClientesController::class, 'osxperiodo'])->name('api.clientes.osxperiodo');

// Ruta para la vista en Vue (Inertia.js)
Route::get('/clientes/osxperiodo', function () {
    return Inertia::render('clientes/osxperiodo'); // El nombre del archivo en Vue debe ser `osxperiodo.vue`
})->name('clientes.osxperiodo');

Route::get('/terminos-de-uso', function () {
    return Inertia::render('Terminos/TerminosDeUso');
})->name('terminos.uso');
require __DIR__.'/auth.php';

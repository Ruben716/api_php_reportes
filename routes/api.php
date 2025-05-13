<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\ReporteController;

Route::post('/reporte-individual', [ReporteController::class, 'generarPDF']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/generar-doc', [DocumentoController::class, 'generarDoc']);

Route::post('/generar-excel', [DocumentoController::class, 'generarExcelDinamico']);

Route::post('/convertir-docx-a-pdf', [DocumentoController::class, 'convertirDocxAPdf']);

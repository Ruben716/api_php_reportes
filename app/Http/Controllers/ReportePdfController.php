<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;

class ReporteController extends Controller
{
    public function generarPDF(Request $request)
    {
        // Validamos lo esencial
        $validated = $request->validate([
            'intern.name' => 'required|string',
            'intern.lastname' => 'required|string',
            'intern.start_date' => 'required|date',
            'intern.end_date' => 'required|date',
            'reportData' => 'required|array',
        ]);

        // Datos que vienen desde Postman
        $intern = $request->input('intern');
        $reportData = $request->input('reportData');

        // Renderiza el HTML con Blade y genera el PDF
        $pdf = Pdf::loadView('reporte.plantilla', [
            'intern' => (object) $intern,
            'reportData' => $reportData,
        ]);

        // Retorna el archivo para descargar directamente en Postman
        return $pdf->download('reporte_individual.pdf');
    }
}

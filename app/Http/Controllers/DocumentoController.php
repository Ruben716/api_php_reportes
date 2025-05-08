<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function generarDoc(Request $request)
    {
        // Cargar plantilla desde storage/app/plantillas
        $templatePath = storage_path('app/plantillas/plantilla.docx');

        if (!file_exists($templatePath)) {
            return response()->json(['error' => 'Plantilla no encontrada'], 404);
        }

        // Iniciar procesador
        $template = new TemplateProcessor($templatePath);

        // Reemplazar variables con los valores del JSON
        foreach ($request->all() as $key => $value) {
            $template->setValue($key, $value);
        }

        // Guardar temporalmente el archivo generado
        $nombreArchivo = 'documento_generado_' . time() . '.docx'; // Nombre con extensión
        $rutaGenerada = storage_path("app/temp/{$nombreArchivo}");

        // Guardar el archivo .docx
        $template->saveAs($rutaGenerada);

        // Descargar el archivo y asegurarse de que tenga nombre correcto
        return response()->download($rutaGenerada, $nombreArchivo)->deleteFileAfterSend(true);
    }
}

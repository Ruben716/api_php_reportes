<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Str;

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

    
    // Generar Excel dinámico
    // Reemplaza las etiquetas en la plantilla Excel con los valores del JSON
    // La plantilla debe tener etiquetas en el formato {{clave}} donde "clave" es la clave del JSON
    // Ejemplo: {{nombre}}, {{edad}}, etc.

    public function generarExcelDinamico(Request $request)
{
    $templatePath = storage_path('app/plantillas/prueba 0001.xlsx');

    if (!file_exists($templatePath)) {
        return response()->json(['error' => 'Plantilla Excel no encontrada'], 404);
    }

    $spreadsheet = IOFactory::load($templatePath);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $request->all(); // JSON recibido

    // Recorremos todas las celdas buscando etiquetas tipo {{clave}}
    foreach ($sheet->getRowIterator() as $row) {
        foreach ($row->getCellIterator() as $cell) {
            $value = $cell->getValue();

            // Verificamos si la celda contiene alguna etiqueta {{clave}}
            if (is_string($value) && preg_match_all('/{{(\w+)}}/', $value, $matches)) {
                foreach ($matches[1] as $match) {
                    if (isset($data[$match])) {
                        // Reemplazamos solo la etiqueta encontrada
                        $replacement = $data[$match];

                        // Si es una fecha, la formateamos (esto depende de cómo viene el JSON)
                        if ($this->esFecha($replacement)) {
                            $replacement = \Carbon\Carbon::parse($replacement)->format('Y-m-d');
                        }

                        // Si es un número, aseguramos que sea numérico
                        if (is_numeric($replacement)) {
                            $replacement = (float) $replacement;
                        }

                        $value = str_replace('{{' . $match . '}}', $replacement, $value);
                    }
                }
                // Actualizamos el valor de la celda
                $cell->setValue($value);
            }
        }
    }

    // Guardamos el archivo
    $nombreArchivo = 'excel_dinamico_' . now()->format('Ymd_His') . '.xlsx';
    $rutaTemporal = storage_path("app/temp/{$nombreArchivo}");

    $writer = new Xlsx($spreadsheet);
    $writer->save($rutaTemporal);

    return response()->download($rutaTemporal, $nombreArchivo)->deleteFileAfterSend(true);
}

// Función auxiliar para determinar si el valor es una fecha
private function esFecha($valor)
{
    return strtotime($valor) !== false;
}



}

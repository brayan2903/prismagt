<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;


class PdfController extends Controller
{
    public function contratoPdf($ruc)
{
    // URL de la API con el RUC
    $url = "https://globaltech.pe/prisma/descargadatos?ruc=" . $ruc;

    // Obtener datos de la API
    $response = Http::get($url);

    // Convertir la respuesta JSON a un array
    $data = $response->json();

    // Verificar si la API devolvió la estructura correcta
    if (!isset($data['data']) || empty($data['data'])) {
        return response()->json(['error' => 'El RUC ingresado no tiene información en la API.'], 404);
    }

    // Extraer solo la información dentro de "data"
    $empresa = $data['data'];

    // Cargar la vista Blade con los datos correctos
    $html = View::make('pdf.contrato', compact('empresa'))->render();

    // Crear el PDF con mPDF
    $mpdf = new Mpdf();
    $mpdf->WriteHTML($html);

    // Mostrar el PDF en el navegador en lugar de descargarlo automáticamente
    $mpdf->Output('contrato_' . $ruc . '.pdf', 'I'); // 'I' muestra el PDF en el navegador
}


    public function cotizacionPdf($param2)
{
    $param1 = 34; // Fijo

    try {
        // Ejecutar el procedimiento almacenado con el segundo parámetro dinámico
        $resultados = DB::select("EXEC Imprimir_Dcmto ?, ?", [$param1, $param2]);

        // Verificar si hay datos
        if (empty($resultados)) {
            return response()->json(['error' => 'No se encontraron datos para la cotización'], 404);
        }

        // Procesar la imagen si está en formato binario
        foreach ($resultados as $resultado) {
            if (isset($resultado->iFoto) && !empty($resultado->iFoto)) {
                // Si la imagen está en binario, conviértela a Base64
                $resultado->iFoto = base64_encode($resultado->iFoto);
            }
        }

        // Renderizar la vista Blade y pasar los datos
        $html = View::make('pdf.cotizacion', compact('resultados', 'param2'))->render();

        // Crear instancia de mPDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        // Mostrar el PDF en el navegador en lugar de descargarlo
        return response()->make($mpdf->Output("Cotizacion_$param2.pdf", 'I'), 200, [
            'Content-Type' => 'application/pdf',
        ]);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}

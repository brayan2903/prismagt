<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
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
        $param1 = 34; // Valor fijo

        try {
            // Ejecutar el procedimiento almacenado con los parámetros
            $resultados = DB::select("EXEC Imprimir_Dcmto ?, ?", [$param1, $param2]);

            // Verificar si hay datos
            if (empty($resultados)) {
                return response()->json(['error' => 'No se encontraron datos para la cotización'], 404);
            }

            // Depuración: Verificar la estructura de $resultados
            Log::info('Datos del procedimiento almacenado:', $resultados);

            // Renderizar la vista Blade y pasar los datos
            $html = View::make('pdf.cotizacion', compact('resultados', 'param2'))->render();

            // Crear instancia de mPDF
            $mpdf = new Mpdf();

            // Escribir el contenido HTML en el PDF
            $mpdf->WriteHTML($html);

            // Mostrar el PDF en el navegador en lugar de descargarlo
            return response()->make($mpdf->Output("Cotizacion_$param2.pdf", 'I'), 200, [
                'Content-Type' => 'application/pdf',
            ]);

        } catch (\Exception $e) {
            // Registrar el error en los logs
            Log::error('Error al generar el PDF: ' . $e->getMessage());

            // Devolver una respuesta de error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

public function cotizacionPdfx($param2)
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
        $html = View::make('pdf.cotizacionx', compact('resultados', 'param2'))->render();

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




public function reporteCombinadoPdf($param2)
{
    $param1 = 34; // Valor fijo

    try {
        // Ejecutar el procedimiento almacenado con los parámetros
        $resultados = DB::select("EXEC Imprimir_Dcmto ?, ?", [$param1, $param2]);

        // Verificar si hay datos
        if (empty($resultados)) {
            return response()->json(['error' => 'No se encontraron datos para la cotización'], 404);
        }

        // Obtener el RUC del primer resultado del procedimiento almacenado
        $ruc = $resultados[0]->RucAnx ?? null;

        if (!$ruc) {
            return response()->json(['error' => 'No se encontró el RUC en los datos del procedimiento almacenado'], 404);
        }

        // Llamar a la API con el RUC obtenido
        $url = "https://globaltech.pe/prisma/descargadatos?ruc=" . $ruc;
        $response = Http::get($url);

        // Verificar si la API devolvió datos válidos
        if (!$response->successful() || !isset($response->json()['data'])) {
            return response()->json(['error' => 'No se pudo obtener información de la API para el RUC proporcionado'], 404);
        }

        // Extraer los datos de la API y asignarlos a $empresa
        $empresa = $response->json()['data'];

        // Combinar los datos del procedimiento almacenado con los datos de la API
        $datosCombinados = [
            'resultados' => $resultados,
            'empresa' => $empresa, // Usamos $empresa en lugar de $datosApi
        ];

        // Renderizar la vista Blade con los datos combinados
        $html = View::make('pdf.reporte_combinado', $datosCombinados)->render();

        // Crear instancia de mPDF
        $mpdf = new Mpdf();

        // Escribir el contenido HTML en el PDF
        $mpdf->WriteHTML($html);

        // Mostrar el PDF en el navegador
        return response()->make($mpdf->Output("Reporte_Combinado_$param2.pdf", 'I'), 200, [
            'Content-Type' => 'application/pdf',
        ]);

    } catch (\Exception $e) {
        // Registrar el error en los logs
        Log::error('Error al generar el PDF: ' . $e->getMessage());

        // Devolver una respuesta de error
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}

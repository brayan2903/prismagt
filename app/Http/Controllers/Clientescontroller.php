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

class ClientesController extends Controller
{
    public function clientesxfacturar(Request $request)
    {
        // Recibimos el parámetro desde el frontend
        $param3 = $request->input('anio_mes'); // Debe enviarse en la petición

        // Parámetros del procedimiento almacenado
        $param1 = 141;
        $param2 = '01';

        // Validamos que el formato sea correcto (ejemplo: '202411')
        if (!preg_match('/^\d{6}$/', $param3)) {
            return response()->json(['error' => 'Formato de AñoMes inválido'], 400);
        }

        // Ejecutamos el procedimiento almacenado con los parámetros
        $clientes = DB::select("EXEC ConsultasV ?, ?, ?", [$param1, $param2, $param3]);

        // Retornamos los datos en formato JSON
        return response()->json($clientes);
    }

    public function osxperiodo(Request $request)
    {
        // Recibimos el parámetro desde el frontend
        $param3 = $request->input('anio_mes'); // Debe enviarse en la petición

        // Parámetros del procedimiento almacenado
        $param1 = 143;  // Nuevo parámetro según tu requerimiento
        $param2 = '01';

        // Validamos que el formato sea correcto (ejemplo: '202411')
        if (!preg_match('/^\d{6}$/', $param3)) {
            return response()->json(['error' => 'Formato de AñoMes inválido'], 400);
        }

        // Ejecutamos el procedimiento almacenado con los parámetros
        $clientes = DB::select("EXEC ConsultasV ?, ?, ?", [$param1, $param2, $param3]);

        // Retornamos los datos en formato JSON
        return response()->json($clientes);
    }
}

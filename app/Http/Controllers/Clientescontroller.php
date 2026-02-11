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



  public function historialEmpresa(Request $request)
    {
        $ruc = $request->input('ruc'); // Ahora recibimos el RUC exacto
        $tipo = $request->input('tipo');

        if (!$ruc) {
            return response()->json([]);
        }

        $sql = "SELECT a.Anx_Id, a.RS, a.NroDI, h.ruc, h.tipo, h.periodo, h.cant, h.imp
                FROM hist h
                INNER JOIN Anx a ON h.ruc = a.NroDI
                WHERE h.ruc = ?"; // Búsqueda exacta

        $params = [$ruc];

        if ($tipo) {
            $sql .= " AND h.tipo = ?";
            $params[] = $tipo;
        }

        $sql .= " ORDER BY h.periodo ASC";

        $resultados = DB::select($sql, $params);
        return response()->json($resultados);
    }

    // Método auxiliar para llenar el Select de "Tipos"
    public function obtenerTipos()
    {
        // Obtiene los tipos distintos para el filtro
        $tipos = DB::select("SELECT DISTINCT tipo FROM hist ORDER BY tipo");
        return response()->json($tipos);
    }

    // Método para llenar el buscador de empresas (Autocomplete)
    public function buscarEmpresas(Request $request)
    {
        $termino = $request->input('q'); // Lo que el usuario escribe

        // Iniciamos la consulta
        // Usamos DISTINCT para no repetir la misma empresa varias veces
        $query = DB::table('hist as h')
            ->join('Anx as a', 'h.ruc', '=', 'a.NroDI')
            ->select('a.NroDI', 'a.RS')
            ->distinct();

        // Si el usuario escribió algo, filtramos
        if ($termino) {
            $query->where(function($q) use ($termino) {
                $q->where('a.RS', 'LIKE', '%' . $termino . '%')
                  ->orWhere('a.NroDI', 'LIKE', '%' . $termino . '%');
            });
        }

        // Limitamos a 20 o 50 resultados para que el select sea rápido
        $empresas = $query->take(50)->get();

        // Formateamos para que AntDesign lo entienda fácil
        $resultado = $empresas->map(function($item) {
            return [
                'value' => $item->NroDI, // El valor real que usaremos para el gráfico
                'label' => $item->RS . ' - ' . $item->NroDI // Lo que ve el usuario
            ];
        });

        return response()->json($resultado);
    }
}

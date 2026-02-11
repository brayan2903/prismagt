<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComparativoController extends Controller
{
    // Solo procesa la lógica de los datos
    public function procesarComparacion(Request $request)
    {
        $prdId = $request->input('prd_id');
        $anio = $request->input('anio');
        $mes = $request->input('mes');
        $tipo = $request->input('tipo');
        $periodo = $anio . $mes;

        if (!$prdId || !$anio || !$mes || !$tipo) {
            return response()->json([]);
        }

        // Consulta de Ventas e Historial
        $ventas = DB::select("
            SELECT a.Anx_Id, a.NroDI, a.RS, d.Prd_Id, h.cant As VendAct, v.Mnd, v.nTC,
            Cast((d.ImpTot/(1+(pIGV/100)))/(Case when v.Mnd='S' Then 3.36 Else 1 End ) As Int) As ValVtaME
            FROM Ventas v
            INNER JOIN Ventas_Det d ON v.Venta_Id=d.Venta_Id
            INNER JOIN Anx a ON a.Anx_Id=v.Anx_Id
            INNER JOIN Hist h ON a.NroDI=h.ruc
            WHERE d.prd_id = ? AND YEAR(v.FDoc) = ? AND h.TIPO = ? AND h.periodo = ?",
        [$prdId, $anio, $tipo, $periodo]);

        // Precios en Contrato
        $preciosPactados = DB::select("SELECT Anx_id, Prd_Id, Precio FROM LP_Anx WHERE Prd_Id = ?", [$prdId]);

        // Catálogo General
       $catalogo = DB::select("SELECT
        p.Prd_Id,
        p.Codigo,
        l.Fct,
        l.Precio
    FROM LP_Det l
    INNER JOIN Prd p ON l.Prd_Id = p.Prd_Id
    WHERE l.Prd_Id = ?
    ORDER BY l.Fct ASC", [$prdId]);

        $colPactados = collect($preciosPactados);
        $colCatalogo = collect($catalogo);

        $resultado = collect($ventas)->map(function($v) use ($colPactados, $colCatalogo) {
            $cantReal = (int)$v->VendAct;

            $contrato = $colPactados->where('Anx_id', $v->Anx_Id)->first();
            $precioPactado = $contrato ? (float)$contrato->Precio : 0;

            $escalaOficial = $colCatalogo->where('Fct', '>=', $cantReal)->first() ?: $colCatalogo->last();

            $precioSugerido = $escalaOficial ? (float)$escalaOficial->Precio : 0;
            $deberiaPagarTotal = $cantReal * $precioSugerido;
            $diferencia = $v->ValVtaME - $deberiaPagarTotal;

            return [
                'anx_id' => $v->Anx_Id,
                'rs' => $v->RS,
                'ruc' => $v->NroDI,
                'cant_real' => $cantReal,
                'pago_factura_me' => (float)$v->ValVtaME,
                'precio_pactado' => $precioPactado,
                'cat_codigo' => $escalaOficial->Codigo ?? '-',
                'cat_fct' => $escalaOficial->Fct ?? 0,
                'cat_precio' => $precioSugerido,
                'diferencia' => $diferencia,
                'status' => $diferencia < -5 ? 'SUBPAGADO' : 'OK'
            ];
        });

        return response()->json($resultado);
    }

    public function obtenerProductos()
    {
        return response()->json(DB::select("SELECT DISTINCT p.Prd_Id, p.Nombre, p.Codigo FROM Prd p INNER JOIN LP_Det l ON p.prd_id = l.prd_id ORDER BY p.Nombre"));
    }

    public function obtenerTipos()
    {
        return response()->json(DB::select("SELECT DISTINCT TIPO FROM Hist ORDER BY TIPO"));
    }
}

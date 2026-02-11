<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteCriticoController extends Controller
{
    public function obtenerCriticos(Request $request)
    {
        $anio = $request->input('anio');
        $mes = $request->input('mes');
        $tipo = $request->input('tipo', 'vend');
        $periodo = $anio . $mes;

        // 1. OBTENER DATOS DE VENTAS E HISTORIAL
        $ventas = DB::select("
            SELECT
                a.Anx_Id, a.NroDI, a.RS,
                d.Prd_Id, p.Nombre as Producto, p.Codigo,
                h.cant As VendAct, -- CANTIDAD REAL DEL HISTORIAL
                v.Mnd, v.nTC,
                -- CÁLCULO DEL COBRO REAL EN DÓLARES SIN IGV
                Cast((d.ImpTot/(1+(d.pIGV/100)))/(Case when v.Mnd='S' Then 3.36 Else 1 End ) As Decimal(10,2)) As PagoFacturaME
            FROM Ventas v
            INNER JOIN Ventas_Det d ON v.Venta_Id = d.Venta_Id
            INNER JOIN Prd p ON d.Prd_Id = p.Prd_Id
            INNER JOIN Anx a ON a.Anx_Id = v.Anx_Id
            INNER JOIN Hist h ON a.NroDI = h.ruc
            WHERE YEAR(v.FDoc) = ? AND h.periodo = ? AND h.TIPO = ?
        ", [$anio, $periodo, $tipo]);

        // 2. OBTENER TODO EL CATÁLOGO
        $colCatalogo = collect(DB::select("SELECT Prd_Id, Fct, Precio FROM LP_Det"));

        // 3. CRUCE DE AUDITORÍA
        $reporte = collect($ventas)->map(function($v) use ($colCatalogo) {
            $cantReal = (int)$v->VendAct;

            // Buscar escala superior en catálogo
            $escala = $colCatalogo->where('Prd_Id', $v->Prd_Id)
                                  ->where('Fct', '>=', $cantReal)
                                  ->sortBy('Fct')
                                  ->first() ?: $colCatalogo->where('Prd_Id', $v->Prd_Id)->last();

            $precioCatUnitario = $escala ? (float)$escala->Precio : 0;
            $montoIdealMes = $cantReal * $precioCatUnitario; // LO QUE DEBERÍA PAGAR
            $diferenciaMes = $v->PagoFacturaME - $montoIdealMes;

            return [
                'ruc' => $v->NroDI,
                'rs' => $v->RS,
                'producto' => $v->Producto,
                'cant_real' => $cantReal,                // ORIGEN: HISTORIAL
                'cobro_real_factura' => (float)$v->PagoFacturaME, // ORIGEN: VENTAS
                'escala_catalogo' => $escala ? $escala->Fct : 0,  // ORIGEN: CATÁLOGO
                'precio_unit_catalogo' => $precioCatUnitario,    // ORIGEN: CATÁLOGO
                'monto_ideal' => (float)$montoIdealMes,           // CÁLCULO
                'diferencia' => (float)$diferenciaMes,            // CÁLCULO
                'perdida_anual' => $diferenciaMes * 12
            ];
        })
        ->sortBy('diferencia') // Los casos más graves (más negativos) primero
        ->values();

        return response()->json($reporte);
    }
}

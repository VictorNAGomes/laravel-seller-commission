<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Seller;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function create(Request $request)
    {
        $seller = Seller::where('id', $request->id_seller)->get();

        if (count($seller->toArray()) == 0) {
            return response()->json([
                'status' => false,
                'message' => 'Vendedor não encontrado'
            ], 404);
        }
        if ($request->value <= 0) {
            return response()->json([
                'status' => false,
                'message' => 'Valor inválido'
            ], 404);
        }

        $sales = new Sales;

        $sales->id_seller =  $request->id_seller;
        $sales->value =  $request->value;

        $sales->save();

        return response()->json([
            'status' => false,
            'message' => 'Venda cadastrada com sucesso'
        ], 201);
    }

    public function getAllSalesFromSeller(int $id_seller)
    {
        $sales =  Sales::where('sellers.id', $id_seller)
            ->join('sellers', 'sales.id_seller', 'sellers.id')
            ->select('sellers.id', 'sellers.name', 'sellers.email', 'sales.value', 'sales.created_at')
            ->get();

        $salesSeller = [];

        foreach ($sales as $sale) {
            array_push($salesSeller, [
                "id" => $sale->id,
                "name" => $sale->name,
                "email" => $sale->email,
                "saleValue" => (float)$sale->value,
                "saleComission" => (float)number_format($sale->value * 0.085, 2),
                "saleDate" => $sale->created_at->format('d/m/Y')
            ]);
        }

        return response()->json($salesSeller, 200, [], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    public static function getAllSalesInTheDay()
    {
        $sales =  Sales::whereRaw('DATE_FORMAT(created_at,\'%Y-%m-%d\') = \'' . now()->format('Y-m-d') . '\'')
            ->selectRaw('sum(value) as total_value')
            ->get();

        return $sales[0]->total_value;
    }
}

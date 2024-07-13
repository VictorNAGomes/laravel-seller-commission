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
}

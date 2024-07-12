<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function create(Request $request)
    {
        if (!$request->name or $request->name == null or $request->name == '') {
            return response()->json([
                'status' => false,
                'message' => 'Nome Inválido'
            ], 400);
        }

        if (!$request->email or $request->email == null or $request->email == '') {
            return response()->json([
                'status' => false,
                'message' => 'Email Inválido'
            ], 400);
        }

        $sellerAlreadyExists = Seller::where('email', $request->email)->get();
        if (count($sellerAlreadyExists->toArray()) > 0) {
            return response()->json([
                'status' => false,
                'message' => 'Email já cadastrado'
            ], 400);
        }

        $seller = new Seller;

        $seller->name = $request->name;
        $seller->email = $request->email;

        $seller->save();

        return response()->json([
            'status' => true,
            'message' => 'Vendedor Criado com sucesso'
        ], 200);
    }

    public function getAll()
    {
        $sellers = Seller::all();

        return $sellers->toArray();
    }

    public function getById(int $id)
    {
        $seller = Seller::where('id', $id)->get();

        if (count($seller->toArray()) == 0) {
            return response()->json([
                'status' => false,
                'message' => 'Vendedor não encontrado'
            ], 404);
        }
        return $seller->toArray();
    }
}

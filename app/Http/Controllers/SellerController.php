<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function getAll()
    {
        $sellers = Seller::all();

        return $sellers->toArray();
    }

    public function getById(int $id)
    {
        $seller = Seller::where('id', $id)->get();

        return $seller->toArray();
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsEagerController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = Product::with('prices')->get();
        
        return view('products.eager', compact('products'));
    }
}

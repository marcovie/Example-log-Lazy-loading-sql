<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsLazyController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = Product::all();
        
        return view('products.lazy', compact('products'));
    }
}

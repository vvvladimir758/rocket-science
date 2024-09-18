<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Filters\ProductFilter;

class ProductController extends Controller
{
    public function index(ProductFilter $filter)
    {
        $products = Product::filter($filter)->limit(40)->get();
        return response()->json($products);
    }

}

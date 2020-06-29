<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products=Product::inRandomOrder()->take(8)->get();
        return view('main', compact('products'));

    }
}

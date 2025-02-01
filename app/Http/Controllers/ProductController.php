<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->orderBy('desc')->get();
        return view('page.products', [
            'titlePage' => 'Товары',
            'products'=> $products
        ]);
    }
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('page.product', [
            'titlePage' => $product->title,
            'product' => $product
        ]);
    }
    public function showBrand($id)
    {
        $products = Product::where('is_active', true)->where('brand_id', $id)->get();
        return view('page.brand-select', [
            'titlePage' => 'Бренд',
            'products'=> $products
        ]);
    }
}

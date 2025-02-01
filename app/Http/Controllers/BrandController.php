<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::where('is_active', true)->orderByDesc('created_at')->get();
        return view('page.brand', [
            'titlePage' => 'Бренды',
            'brands' => $brands
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the products from the API
     */
    public function index()
    {
        try {
            $response = Http::get('https://fakestoreapi.com/products');

            if ($response->failed()) {
                return view('api_products.index', ['error' => 'Error al cargar los productos.']);
            }

            $products = $response->json();
            return view('api_products.index', compact('products'));
        } catch (\Exception $e) {
            return view('api_products.index', ['error' => 'Error de conexión: ' . $e->getMessage()]);
        }
    }
}

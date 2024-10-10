<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Sort products by price
     */
    public function sortByPrice(Request $request)
    {
        $order = $request->input('order', 'asc');
    
        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'asc';
        }
    
        $products = Product::orderBy('price', $order)->get();
        return response()->json($products);
    }

    /**
     * Calculate the total stock of all products
     */
    public function calculateTotalStock()
    {
        $totalStock = Product::sum('stock');
        return response()->json(['totalStock' => $totalStock]);
    }

    /**
     * Show the form for creating a new resource
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente.');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'      => 'required|string|max:255',
            'categoria'   => 'required|string',
            'precio'      => 'required|numeric',
            'stock'       => 'required|integer',
            'descripcion' => 'required|string|max:500',
            'imagen'      => 'required|image|max:2048'
        ]);

        $productData = [
            'name'        => $data['nombre'],
            'category'    => $data['categoria'],
            'price'       => $data['precio'],
            'stock'       => $data['stock'],
            'description' => $data['descripcion'],
        ];

        if ($request->hasFile('imagen')) {
            $productData['image'] = $request->file('imagen')->store('productos', 'public');
        }

        Product::create($productData);

        return back()->with('success', '¡Producto "' . $data['nombre'] . '" agregado correctamente al inventario!');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'nombre'      => 'required|string|max:255',
            'categoria'   => 'required|string',
            'precio'      => 'required|numeric',
            'stock'       => 'required|integer',
            'descripcion' => 'required|string|max:500',
            'imagen'      => 'nullable|image|max:2048'
        ]);

        $productData = [
            'name'        => $data['nombre'],
            'category'    => $data['categoria'],
            'price'       => $data['precio'],
            'stock'       => $data['stock'],
            'description' => $data['descripcion'],
        ];

        if ($request->hasFile('imagen')) {
            $productData['image'] = $request->file('imagen')->store('productos', 'public');
        }

        $product->update($productData);

        return back()->with('success', '¡Producto "' . $data['nombre'] . '" actualizado correctamente!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Producto eliminado.');
    }

    public function toggleStock(Product $product)
    {
        // Si tiene stock lo pone en 0, si está en 0 lo restaura a 10 (por defecto)
        if ($product->stock > 0) {
            $product->update(['stock' => 0]);
            $msg = 'Producto marcado como agotado.';
        } else {
            $product->update(['stock' => 10]);
            $msg = 'Stock restaurado a 10 unidades.';
        }
        return back()->with('success', $msg);
    }

    public function catalogo()
    {
        $products = Product::all();
        return view('catalogo', compact('products'));
    }
}
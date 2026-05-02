<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;

// 🔥 IMPORTANTE
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    // 🔥 ESTO SOLUCIONA EL ERROR
    use AuthorizesRequests;

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('create', Product::class);
        return view('products.create');
    }

    public function store(StoreProductoRequest $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'usuario_id' => auth()->id()
        ]);

        // 🔥 LOG
        Log::channel('productos')->info('Producto creado', [
            'usuario_id' => auth()->id(),
            'producto_id' => $product->id
        ]);

        return redirect('/products');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductoRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $product->update([
            'name' => $request->nombre,
            'description' => $request->descripcion,
            'price' => $request->precio,
            'stock' => $request->stock,
        ]);

        Log::channel('productos')->info('Producto actualizado', [
            'usuario_id' => auth()->id(),
            'producto_id' => $product->id
        ]);

        return redirect('/products');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();

        Log::channel('productos')->warning('Producto eliminado', [
            'usuario_id' => auth()->id(),
            'producto_id' => $product->id
        ]);

        return redirect('/products');
    }

    public function catalogo()
    {
        $products = Product::all();
        return view('catalogo', compact('products'));
    }
}
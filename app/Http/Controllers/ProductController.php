<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Producto::class);

        $products = Producto::with('usuario')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('create', Producto::class);
        return view('products.create');
    }

    public function store(StoreProductoRequest $request)
    {
        $this->authorize('create', Producto::class);

        $data = $request->validated();

        $productoData = [
            'nombre'      => $data['nombre'],
            'precio'      => $data['precio'],
            'existencia'  => $data['existencia'],
            'descripcion' => $data['descripcion'],
            'usuario_id'  => auth()->id(),
        ];

        if ($request->hasFile('imagen')) {
            $productoData['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto = Producto::create($productoData);

        // Bitácora
        Log::channel('productos')->info('Producto creado', [
            'producto_id' => $producto->id,
            'nombre'      => $producto->nombre,
            'usuario_id'  => auth()->id(),
            'ip'          => $request->ip(),
        ]);

        return back()->with('success', '¡Producto "' . $data['nombre'] . '" agregado correctamente al inventario!');
    }

    public function update(UpdateProductoRequest $request, Producto $product)
    {
        $this->authorize('update', $product);

        $data = $request->validated();

        $productoData = [
            'nombre'      => $data['nombre'],
            'precio'      => $data['precio'],
            'existencia'  => $data['existencia'],
            'descripcion' => $data['descripcion'],
        ];

        if ($request->hasFile('imagen')) {
            $productoData['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $product->update($productoData);

        // Bitácora
        Log::channel('productos')->info('Producto editado', [
            'producto_id' => $product->id,
            'nombre'      => $product->nombre,
            'usuario_id'  => auth()->id(),
            'ip'          => $request->ip(),
        ]);

        return back()->with('success', '¡Producto "' . $data['nombre'] . '" actualizado correctamente!');
    }

    public function destroy(Producto $product)
    {
        $this->authorize('delete', $product);

        $nombre = $product->nombre;
        $product->delete();

        // Bitácora
        Log::channel('productos')->info('Producto eliminado', [
            'nombre'     => $nombre,
            'usuario_id' => auth()->id(),
            'ip'         => request()->ip(),
        ]);

        return back()->with('success', 'Producto eliminado.');
    }

    public function toggleStock(Producto $product)
    {
        $this->authorize('update', $product);

        if ($product->existencia > 0) {
            $product->update(['existencia' => 0]);
            $msg = 'Producto marcado como agotado.';
        } else {
            $product->update(['existencia' => 10]);
            $msg = 'Stock restaurado a 10 unidades.';
        }
        return back()->with('success', $msg);
    }

    public function catalogo()
    {
        $products = Producto::with('usuario')->get();
        return view('catalogo', compact('products'));
    }
}
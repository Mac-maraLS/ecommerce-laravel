<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function catalogo(): View
    {
        return view('catalogo', [
            'productos' => Producto::query()->with(['vendedor', 'categorias'])->latest()->get(),
        ]);
    }

    public function index(): View
    {
        $this->authorize('viewAny', Producto::class);

        return view('productos.index', [
            'productos' => Producto::query()->with(['vendedor', 'categorias'])->latest()->get(),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Producto::class);

        return view('productos.create', [
            'categorias' => Categoria::orderBy('nombre')->get(),
            'vendedores' => Usuario::query()
                ->where('rol', Usuario::ROL_VENDEDOR)
                ->orderBy('nombre')
                ->get(),
        ]);
    }

    public function store(StoreProductoRequest $request): RedirectResponse
    {
        $this->authorize('create', Producto::class);

        $data = $request->validated();
        $fotos = [];

        foreach ($request->file('fotos', []) as $foto) {
            $fotos[] = $foto->store('productos', 'public');
        }

        $producto = Producto::create(
            collect($data)->except('categorias', 'fotos')->merge(['fotos' => $fotos])->all()
        );
        $producto->categorias()->sync($data['categorias']);

        Log::channel('productos')->info('Producto creado', [
            'producto_id' => $producto->id,
            'usuario_id' => $request->user()->id,
            'ip' => $request->ip(),
        ]);

        return redirect()->route('productos.index')->with('status', 'Producto creado correctamente.');
    }

    public function edit(Producto $producto): View
    {
        $this->authorize('update', $producto);

        return view('productos.edit', [
            'producto' => $producto->load('categorias'),
            'categorias' => Categoria::orderBy('nombre')->get(),
            'vendedores' => Usuario::query()
                ->where('rol', Usuario::ROL_VENDEDOR)
                ->orderBy('nombre')
                ->get(),
        ]);
    }

    public function update(UpdateProductoRequest $request, Producto $producto): RedirectResponse
    {
        $this->authorize('update', $producto);

        $data = $request->validated();

        if ($request->hasFile('fotos')) {
            foreach ($producto->fotos ?? [] as $foto) {
                Storage::disk('public')->delete($foto);
            }

            $data['fotos'] = collect($request->file('fotos'))
                ->map(fn ($foto) => $foto->store('productos', 'public'))
                ->all();
        }

        $producto->update(collect($data)->except('categorias')->all());
        $producto->categorias()->sync($data['categorias']);

        Log::channel('productos')->info('Producto editado', [
            'producto_id' => $producto->id,
            'usuario_id' => $request->user()->id,
            'ip' => $request->ip(),
        ]);

        return redirect()->route('productos.index')->with('status', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto): RedirectResponse
    {
        $this->authorize('delete', $producto);

        $productoId = $producto->id;
        $usuarioId = request()->user()->id;
        $ip = request()->ip();

        foreach ($producto->fotos ?? [] as $foto) {
            Storage::disk('public')->delete($foto);
        }

        $producto->delete();

        Log::channel('productos')->info('Producto eliminado', [
            'producto_id' => $productoId,
            'usuario_id' => $usuarioId,
            'ip' => $ip,
        ]);

        return redirect()->route('productos.index')->with('status', 'Producto eliminado correctamente.');
    }
}

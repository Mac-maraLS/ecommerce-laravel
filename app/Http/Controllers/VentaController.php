<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVentaRequest;
use App\Http\Requests\UpdateVentaRequest;
use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Venta;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class VentaController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Venta::class);

        $ventas = Venta::query()->with(['producto', 'cliente', 'vendedor'])->latest();

        if (auth()->user()->esCliente()) {
            $ventas->where('cliente_id', auth()->id());
        }

        return view('ventas.index', [
            'ventas' => $ventas->get(),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Venta::class);

        return view('ventas.create', [
            'productos' => Producto::query()->with('vendedor')->orderBy('nombre')->get(),
            'clientes' => Usuario::query()->where('rol', Usuario::ROL_CLIENTE)->orderBy('nombre')->get(),
        ]);
    }

    public function store(StoreVentaRequest $request): RedirectResponse
    {
        $this->authorize('create', Venta::class);

        $producto = Producto::findOrFail($request->validated('producto_id'));
        $clienteId = auth()->user()->esCliente() ? auth()->id() : (int) $request->validated('cliente_id');

        $venta = Venta::create([
            'producto_id' => $producto->id,
            'vendedor_id' => $producto->usuario_id,
            'cliente_id' => $clienteId,
            'fecha' => $request->validated('fecha'),
            'total' => $request->validated('total'),
        ]);

        Log::channel('ventas')->info('Venta creada', [
            'venta_id' => $venta->id,
            'producto_id' => $producto->id,
            'cliente_id' => $clienteId,
            'vendedor_id' => $producto->usuario_id,
            'ip' => $request->ip(),
        ]);

        return redirect()->route('ventas.index')->with('status', 'Venta registrada correctamente.');
    }

    public function show(Venta $venta): View
    {
        $this->authorize('view', $venta);

        return view('ventas.show', [
            'venta' => $venta->load(['producto', 'cliente', 'vendedor']),
        ]);
    }

    public function edit(Venta $venta): View
    {
        $this->authorize('update', $venta);

        return view('ventas.edit', [
            'venta' => $venta,
            'productos' => Producto::query()->with('vendedor')->orderBy('nombre')->get(),
            'clientes' => Usuario::query()->where('rol', Usuario::ROL_CLIENTE)->orderBy('nombre')->get(),
        ]);
    }

    public function update(UpdateVentaRequest $request, Venta $venta): RedirectResponse
    {
        $this->authorize('update', $venta);

        $producto = Producto::findOrFail($request->validated('producto_id'));

        $venta->update([
            'producto_id' => $producto->id,
            'vendedor_id' => $producto->usuario_id,
            'cliente_id' => $request->validated('cliente_id'),
            'fecha' => $request->validated('fecha'),
            'total' => $request->validated('total'),
        ]);

        return redirect()->route('ventas.index')->with('status', 'Venta actualizada correctamente.');
    }

    public function destroy(Venta $venta): RedirectResponse
    {
        $this->authorize('delete', $venta);

        $venta->delete();

        return redirect()->route('ventas.index')->with('status', 'Venta eliminada correctamente.');
    }
}

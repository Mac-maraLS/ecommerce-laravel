<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\VentaValidadaComprador;
use App\Mail\VentaValidadaVendedor;
use App\Http\Requests\StoreVentaRequest;

class VentaController extends Controller
{
    // 📄 FORMULARIO DE COMPRA
    public function create($id)
    {
        $product = Product::findOrFail($id);

        return view('ventas.create', compact('product'));
    }

    // 💾 GUARDAR COMPRA
    public function store(StoreVentaRequest $request)
    {
        // Guardar imagen en privado
        $ruta = $request->file('ticket')->store('tickets', 'local');

        Venta::create([
            'usuario_id' => auth()->id(),
            'product_id' => $request->product_id,
            'ticket' => $ruta,
            'validada' => false
        ]);

        return redirect('/catalogo')->with('success', 'Compra realizada');
    }

    // 📊 LISTAR VENTAS
    public function index()
    {
        $ventas = Venta::with('usuario','producto')->get();

        return view('ventas.index', compact('ventas'));
    }

    // 📂 VER TICKET
    public function verTicket($id)
    {
        $venta = Venta::findOrFail($id);

        return Storage::disk('local')->download($venta->ticket);
    }

    // ✅ VALIDAR VENTA
    public function validar($id)
    {
        $venta = Venta::findOrFail($id);

        $venta->update([
            'validada' => true
        ]);

        // Correo comprador
        Mail::to($venta->usuario->correo)
            ->send(new VentaValidadaComprador($venta));

        // Correo vendedor (simulado)
        Mail::to('vendedor@correo.com')
            ->send(new VentaValidadaVendedor($venta));

        return back()->with('success', 'Venta validada');
    }
}
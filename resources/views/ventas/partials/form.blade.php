<div class="grid cols-2">
    <label>
        Producto
        <select name="producto_id" required>
            @foreach($productos as $producto)
                <option value="{{ $producto->id }}" @selected(old('producto_id', $venta?->producto_id) == $producto->id)>
                    {{ $producto->nombre }} | vendedor: {{ $producto->vendedor->nombre_completo }}
                </option>
            @endforeach
        </select>
    </label>

    <label>
        Cliente
        <select name="cliente_id" required @disabled(auth()->user()->esCliente())>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}" @selected(old('cliente_id', $venta?->cliente_id ?? auth()->id()) == $cliente->id)>
                    {{ $cliente->nombre_completo }}
                </option>
            @endforeach
        </select>
        @if(auth()->user()->esCliente())
            <input type="hidden" name="cliente_id" value="{{ auth()->id() }}">
        @endif
    </label>

    <label>
        Fecha
        <input type="date" name="fecha" value="{{ old('fecha', optional($venta?->fecha)->format('Y-m-d') ?? now()->toDateString()) }}" required>
    </label>

    <label>
        Total
        <input type="number" step="0.01" name="total" value="{{ old('total', $venta?->total) }}" required>
    </label>
</div>

<div class="actions">
    <button class="button" type="submit">Guardar</button>
    <a class="button secondary" href="{{ route('ventas.index') }}">Cancelar</a>
</div>

<div class="grid cols-2">
    <label>
        Nombre
        <input type="text" name="nombre" value="{{ old('nombre', $producto?->nombre) }}" required>
    </label>

    <label>
        Precio
        <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto?->precio) }}" required>
    </label>

    <label>
        Existencia
        <input type="number" name="existencia" value="{{ old('existencia', $producto?->existencia) }}" required>
    </label>

    <label>
        Vendedor
        <select name="usuario_id" required>
            @foreach($vendedores as $vendedor)
                <option value="{{ $vendedor->id }}" @selected(old('usuario_id', $producto?->usuario_id) == $vendedor->id)>
                    {{ $vendedor->nombre_completo }} ({{ $vendedor->rol }})
                </option>
            @endforeach
        </select>
    </label>
</div>

<label>
    Descripcion
    <textarea name="descripcion" required>{{ old('descripcion', $producto?->descripcion) }}</textarea>
</label>

<label>
    Fotos del producto
    <input type="file" name="fotos[]" accept="image/*" multiple @required($producto === null)>
</label>

@if($producto?->fotos)
    <div class="thumbs">
        @foreach($producto->fotos as $foto)
            <img src="{{ asset('storage/'.$foto) }}" alt="{{ $producto->nombre }}">
        @endforeach
    </div>
@endif

<label>
    Categorias
    <select name="categorias[]" multiple size="6" required>
        @php($seleccionadas = old('categorias', $producto?->categorias->pluck('id')->all() ?? []))
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}" @selected(in_array($categoria->id, $seleccionadas))>{{ $categoria->nombre }}</option>
        @endforeach
    </select>
</label>

<div class="actions">
    <button class="button" type="submit">Guardar</button>
    <a class="button secondary" href="{{ route('productos.index') }}">Cancelar</a>
</div>

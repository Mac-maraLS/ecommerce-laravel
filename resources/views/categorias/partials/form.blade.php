<label>
    Nombre
    <input type="text" name="nombre" value="{{ old('nombre', $categoria?->nombre) }}" required>
</label>

<label>
    Descripcion
    <textarea name="descripcion" required>{{ old('descripcion', $categoria?->descripcion) }}</textarea>
</label>

<div class="actions">
    <button class="button" type="submit">Guardar</button>
    <a class="button secondary" href="{{ route('categorias.index') }}">Cancelar</a>
</div>

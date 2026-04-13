<div class="grid cols-2">
    <label>
        Nombre
        <input type="text" name="nombre" value="{{ old('nombre', $usuario?->nombre) }}" required>
    </label>

    <label>
        Apellidos
        <input type="text" name="apellidos" value="{{ old('apellidos', $usuario?->apellidos) }}" required>
    </label>

    <label>
        Correo
        <input type="email" name="correo" value="{{ old('correo', $usuario?->correo) }}" required>
    </label>

    <label>
        Rol
        <select name="rol" required>
            @foreach([\App\Models\Usuario::ROL_ADMINISTRADOR, \App\Models\Usuario::ROL_GERENTE, \App\Models\Usuario::ROL_CLIENTE] as $rol)
                <option value="{{ $rol }}" @selected(old('rol', $usuario?->rol) === $rol)>{{ $rol }}</option>
            @endforeach
        </select>
    </label>
    <label>
        Clave {{ $usuario ? '(dejar vacia para no cambiar)' : '' }}
        <input type="password" name="clave" {{ $usuario ? '' : 'required' }}>
    </label>
</div>

<div class="actions">
    <button class="button" type="submit">Guardar</button>
    <a class="button secondary" href="{{ route('usuarios.index') }}">Cancelar</a>
</div>

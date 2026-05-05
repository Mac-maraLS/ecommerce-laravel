<h1>Codigo de verificacion</h1>

<p>Hola {{ $usuario->nombre_completo }}.</p>
<p>Tu codigo de acceso es: <strong>{{ $codigoVerificacion->codigo }}</strong></p>
<p>Expira el {{ $codigoVerificacion->expiracion->format('Y-m-d H:i:s') }}.</p>

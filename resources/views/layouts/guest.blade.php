<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Acceso' }}</title>
    <style>
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; background: linear-gradient(135deg, #f5f3ff, #ffedd5); font-family: Georgia, serif; }
        .panel { width: min(420px, calc(100% - 32px)); background: white; padding: 28px; border-radius: 20px; border: 1px solid #d6d3d1; }
        h1 { margin-top: 0; }
        label { display: block; margin-bottom: 14px; font-weight: 700; }
        input { width: 100%; box-sizing: border-box; padding: 10px 12px; border-radius: 10px; border: 1px solid #cbd5e1; }
        button { width: 100%; padding: 12px; border: none; border-radius: 10px; background: #9a3412; color: white; font: inherit; cursor: pointer; }
        .error { color: #b91c1c; margin-bottom: 12px; }
        .hint { margin-top: 16px; color: #57534e; font-size: 14px; }
    </style>
</head>
<body>
    <div class="panel">
        @yield('content')
    </div>
</body>
</html>

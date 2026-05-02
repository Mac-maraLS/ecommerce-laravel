@extends('layouts.admin')

@section('content')

<h1>Dashboard</h1>

<p>Total usuarios: {{ \App\Models\Usuario::count() }}</p>

<p>Vendedores:
{{ \App\Models\Usuario::where('rol','vendedor')->count() }}</p>

<p>Clientes:
{{ \App\Models\Usuario::where('rol','cliente')->count() }}</p>

<p>Producto más vendido:
{{ \App\Models\Product::withCount('ventas')
->orderByDesc('ventas_count')
->first()->name ?? 'N/A' }}
</p>

@endsection
<h1>🛒 Mi Tienda</h1>

<a href="/products/create">➕ Crear producto</a>

<hr>

@foreach($products as $product)
    <div style="border:1px solid #ccc; padding:10px; margin:10px;">
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->description }}</p>
        <strong>$ {{ $product->price }}</strong><br>
        <small>Stock: {{ $product->stock }}</small>
    </div>
@endforeach

<h1>➕ Nuevo Producto</h1>

<form action="/products" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Nombre"><br><br>

    <textarea name="description" placeholder="Descripción"></textarea><br><br>

    <input type="number" step="0.01" name="price" placeholder="Precio"><br><br>

    <input type="number" name="stock" placeholder="Stock"><br><br>

    <button type="submit">Guardar</button>
</form>
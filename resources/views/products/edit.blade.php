<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-light text-dark">
    <div class="container">
        <h1 class="title">Editar Producto</h1>
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" value="{{ $product->name }}" required class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Descripción:</label>
                <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Precio:</label>
                <input type="number" name="price" id="price" value="{{ $product->price }}" step="0.01" required class="form-control">
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" name="stock" id="stock" value="{{ $product->stock }}" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
        </form>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver a la lista de productos</a>
    </div>
</body>
</html>

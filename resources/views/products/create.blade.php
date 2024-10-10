<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-light text-dark">
    <div class="container">
        <h1 class="title">Crear Producto</h1>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" required class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Descripción:</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Precio:</label>
                <input type="number" name="price" id="price" step="0.01" required class="form-control">
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" name="stock" id="stock" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Crear Producto</button>
        </form>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver a la lista de productos</a>
    </div>
</body>
</html>

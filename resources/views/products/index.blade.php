<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lista de Productos</title>
    @vite('resources/css/app.css')
    @vite('resources/js/stock.js')
</head>
<body class="bg-light text-dark">
    <div class="container">
        <h1 class="title">Productos</h1>

        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
            Añadir Producto
        </a>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        <div class="alert alert-info" id="sortAlert" style="display: none;">
        </div>

        <div class="actions mt-4">
            <button class="btn btn-primary" id="sortButton">Ordenar por Precio</button>
            <button class="btn btn-secondary" id="calculateStockButton">Calcular Stock Total</button>
        </div>

        <div class="table-wrapper mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td data-price="{{ $product->price }}">{{ number_format($product->price, 2) }} €</td>
                            <td data-stock="{{ $product->stock }}">{{ $product->stock }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-link">
                                    Editar
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

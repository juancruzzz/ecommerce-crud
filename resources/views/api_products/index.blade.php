<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos desde API</title>
    @vite('resources/css/app.css')
    <script>
        function showLoading() {
            document.getElementById('loading').style.display = 'block';
            document.getElementById('productTable').style.display = 'none';
        }
    </script>
</head>
<body class="bg-light text-dark">
    <div class="container">
        <h1 class="title">Lista de Productos desde API</h1>

        @if (isset($error))
            <div class="alert">{{ $error }}</div>
        @endif

        <a href="{{ route('api.products.index') }}" class="btn btn-primary" onclick="showLoading()">Recargar Productos</a>

        <div id="loading" style="display: none; text-align: center;">
            <p>Cargando productos...</p>
        </div>

        <div class="table-wrapper mt-4" id="productTable">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product['title'] }}</td>
                            <td>{{ $product['description'] }}</td>
                            <td>${{ $product['price'] }}</td>
                            <td>
                                <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" style="width: 50px; height: auto;">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

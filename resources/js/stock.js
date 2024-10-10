document.addEventListener("DOMContentLoaded", () => {
    const sortButton = document.getElementById('sortButton');
    const calculateStockButton = document.getElementById('calculateStockButton');

    let currentSortOrder = 'none';

    sortButton.addEventListener('click', () => {
        currentSortOrder = getNextSortOrder(currentSortOrder);
        sortProductsByPrice(currentSortOrder);
    });

    calculateStockButton.addEventListener('click', calculateTotalStock);
});

/**
 * Returns the next sort state in the loop
 * @param {string} currentOrder - Current state
 * @returns {string} - Next state
 */
function getNextSortOrder(currentOrder) {
    if (currentOrder === 'none') return 'asc';
    if (currentOrder === 'asc') return 'desc';
    return 'none';
}

/**
 * Send a request to sort products by price
 * @param {string} order - The sort order ('asc', 'desc', 'none')
 */
async function sortProductsByPrice(order) {
    try {
        const response = await fetch('/products/sort-by-price', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            body: JSON.stringify({ order })
        });

        if (response.ok) {
            const sortedProducts = await response.json();
            updateProductList(sortedProducts);
            updateSortAlert(order);
        } else {
            console.error('Error al ordenar los productos:', response.statusText);
        }
    } catch (error) {
        console.error('Error en la solicitud de ordenación:', error);
    }
}

/**
 * Send a request to calculate the total stock of all products
 */
async function calculateTotalStock() {
    try {
        const response = await fetch('/products/calculate-total-stock', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken()
            }
        });

        if (response.ok) {
            const { totalStock } = await response.json();
            showStockAlert(totalStock);
        } else {
            console.error('Error al calcular el stock total:', response.statusText);
        }
    } catch (error) {
        console.error('Error en la solicitud de cálculo de stock:', error);
    }
}

/**
 * Displays an alert with the total stock
 * @param {number} totalStock - The total stock calculated
 */
function showStockAlert(totalStock) {
    alert(`El stock total de todos los productos es: ${totalStock}`);
}

/**
 * Updates the sort alert in the interface
 * @param {string} order - The current order of ordination
 */
function updateSortAlert(order) {
    const sortAlert = document.getElementById('sortAlert');
    const messages = {
        asc: 'Productos ordenados por precio: de menor a mayor.',
        desc: 'Productos ordenados por precio: de mayor a menor.',
        none: 'Orden de productos restablecido.'
    };
    sortAlert.textContent = messages[order];
    sortAlert.style.display = 'block';
}

/**
 * Updates the list of products in the table
 * @param {Array} products - List of products
 */
function updateProductList(products) {
    const tableBody = document.getElementById('productTableBody');
    tableBody.innerHTML = '';

    products.forEach(product => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${product.name}</td>
            <td>${product.description}</td>
            <td data-price="${product.price}">${product.price} €</td>
            <td data-stock="${product.stock}">${product.stock}</td>
            <td>
                <a href="/products/${product.id}/edit" class="btn btn-link">Editar</a>
                <form action="/products/${product.id}" method="POST" class="inline-form">
                    <input type="hidden" name="_token" value="${getCsrfToken()}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

/**
 * Gets the CSRF token from the meta tag
 * @returns {string} - The CSRF token
 */
function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

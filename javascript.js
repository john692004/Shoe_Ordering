// Data Storage (using localStorage for persistence)
let orders = JSON.parse(localStorage.getItem('orders')) || [];
let products = JSON.parse(localStorage.getItem('products')) || [];
let customers = JSON.parse(localStorage.getItem('customers')) || [];

// Initialize with sample data if empty
if (orders.length === 0) {
    orders = [
        { id: 1, customerId: 1, total: 150.00, date: '2025-04-01' },
        { id: 2, customerId: 2, total: 200.00, date: '2025-04-02' }
    ];
    localStorage.setItem('orders', JSON.stringify(orders));
}

if (products.length === 0) {
    products = [
        { id: 1, name: 'Laptop', price: 1000.00, stock: 50 },
        { id: 2, name: 'Smartphone', price: 500.00, stock: 100 }
    ];
    localStorage.setItem('products', JSON.stringify(products));
}

if (customers.length === 0) {
    customers = [
        { id: 1, name: 'Alice Smith', email: 'alice@example.com' },
        { id: 2, name: 'Bob Johnson', email: 'bob@example.com' }
    ];
    localStorage.setItem('customers', JSON.stringify(customers));
}

// Sidebar Toggle
document.querySelector('.toggle-btn').addEventListener('click', () => {
    document.querySelector('.sidebar').classList.toggle('collapsed');
});

// Sidebar Navigation
const navItems = document.querySelectorAll('.nav-item');
const pageTitle = document.getElementById('page-title');
const sections = document.querySelectorAll('.section');

navItems.forEach(item => {
    item.addEventListener('click', () => {
        // Remove active class from all items
        navItems.forEach(i => i.classList.remove('active'));
        // Add active class to clicked item
        item.classList.add('active');

        // Get the section to display
        const section = item.getAttribute('data-section');
        updateContent(section);
    });
});

// Function to navigate to a section programmatically
function navigateToSection(section) {
    navItems.forEach(item => {
        if (item.getAttribute('data-section') === section) {
            item.click();
        }
    });
}

// Function to update content based on the selected section
function updateContent(section) {
    // Update page title
    pageTitle.textContent = section.charAt(0).toUpperCase() + section.slice(1).replace('-', ' ');

    // Show/hide sections
    sections.forEach(s => s.style.display = 'none');
    document.getElementById(`${section}-section`).style.display = 'block';

    // Update data for the section
    if (section === 'dashboard') {
        updateDashboardStats();
    } else if (section === 'orders') {
        renderOrdersTable();
        populateCustomerDropdown();
    } else if (section === 'products') {
        renderProductsTable();
    } else if (section === 'stock') {
        renderStockTable();
        populateProductDropdown();
    } else if (section === 'customers') {
        renderCustomersTable();
    } else if (section === 'sales') {
        updateSalesCharts();
    }
}

// User Menu Toggle
function toggleUserMenu() {
    const userMenu = document.getElementById('user-menu');
    userMenu.style.display = userMenu.style.display === 'block' ? 'none' : 'block';
}

function logout() {
    alert('Logged out!');
    // Add actual logout logic here (e.g., redirect to login page)
}

// Dashboard Stats
function updateDashboardStats() {
    document.getElementById('total-orders').textContent = orders.length;
    document.getElementById('revenue').textContent = `$${orders.reduce((sum, order) => sum + order.total, 0).toFixed(2)}`;
    document.getElementById('customers').textContent = customers.length;
    document.getElementById('stock').textContent = products.reduce((sum, product) => sum + product.stock, 0);
    updateDashboardCharts();
}

// Orders Table
function renderOrdersTable() {
    const tbody = document.getElementById('orders-table-body');
    tbody.innerHTML = '';
    orders.forEach(order => {
        const customer = customers.find(c => c.id === order.customerId);
        const row = `
            <tr>
                <td>${order.id}</td>
                <td>${customer ? customer.name : 'Unknown'}</td>
                <td>$${order.total.toFixed(2)}</td>
                <td>${order.date}</td>
                <td>
                    <button class="edit-btn" onclick="editOrder(${order.id})">Edit</button>
                    <button class="delete-btn" onclick="deleteOrder(${order.id})">Delete</button>
                </td>
            </tr>
        `;
        tbody.innerHTML += row;
    });
}

function addOrder(event) {
    event.preventDefault();
    const customerId = parseInt(document.getElementById('order-customer').value);
    const total = parseFloat(document.getElementById('order-total').value);
    const date = document.getElementById('order-date').value;
    const newOrder = {
        id: orders.length ? Math.max(...orders.map(o => o.id)) + 1 : 1,
        customerId,
        total,
        date
    };
    orders.push(newOrder);
    localStorage.setItem('orders', JSON.stringify(orders));
    closeModal('add-order-modal');
    renderOrdersTable();
    updateDashboardStats();
}

function editOrder(id) {
    alert(`Edit order ${id} - Implement edit functionality here.`);
    // Add edit modal or form logic here
}

function deleteOrder(id) {
    if (confirm('Are you sure you want to delete this order?')) {
        orders = orders.filter(order => order.id !== id);
        localStorage.setItem('orders', JSON.stringify(orders));
        renderOrdersTable();
        updateDashboardStats();
    }
}

// Products Table
function renderProductsTable() {
    const tbody = document.getElementById('products-table-body');
    tbody.innerHTML = '';
    products.forEach(product => {
        const row = `
            <tr>
                <td>${product.id}</td>
                <td>${product.name}</td>
                <td>$${product.price.toFixed(2)}</td>
                <td>${product.stock}</td>
                <td>
                    <button class="edit-btn" onclick="editProduct(${product.id})">Edit</button>
                    <button class="delete-btn" onclick="deleteProduct(${product.id})">Delete</button>
                </td>
            </tr>
        `;
        tbody.innerHTML += row;
    });
}

function addProduct(event) {
    event.preventDefault();
    const name = document.getElementById('product-name').value;
    const price = parseFloat(document.getElementById('product-price').value);
    const stock = parseInt(document.getElementById('product-stock').value);
    const newProduct = {
        id: products.length ? Math.max(...products.map(p => p.id)) + 1 : 1,
        name,
        price,
        stock
    };
    products.push(newProduct);
    localStorage.setItem('products', JSON.stringify(products));
    closeModal('add-product-modal');
    renderProductsTable();
    updateDashboardStats();
}

function editProduct(id) {
    alert(`Edit product ${id} - Implement edit functionality here.`);
    // Add edit modal or form logic here
}

function deleteProduct(id) {
    if (confirm('Are you sure you want to delete this product?')) {
        products = products.filter(product => product.id !== id);
        localStorage.setItem('products', JSON.stringify(products));
        renderProductsTable();
        renderStockTable();
        updateDashboardStats();
    }
}

// Stock Table
function renderStockTable() {
    const tbody = document.getElementById('stock-table-body');
    tbody.innerHTML = '';
    products.forEach(product => {
        const row = `
            <tr>
                <td>${product.id}</td>
                <td>${product.name}</td>
                <td>${product.stock}</td>
                <td>
                    <button class="edit-btn" onclick="openModal('update-stock-modal', ${product.id})">Update</button>
                </td>
            </tr>
        `;
        tbody.innerHTML += row;
    });
}

function updateStock(event) {
    event.preventDefault();
    const productId = parseInt(document.getElementById('stock-product').value);
    const quantity = parseInt(document.getElementById('stock-quantity').value);
    const product = products.find(p => p.id === productId);
    if (product) {
        product.stock = quantity;
        localStorage.setItem('products', JSON.stringify(products));
        closeModal('update-stock-modal');
        renderStockTable();
        renderProductsTable();
        updateDashboardStats();
    }
}

// Customers Table
function renderCustomersTable() {
    const tbody = document.getElementById('customers-table-body');
    tbody.innerHTML = '';
    customers.forEach(customer => {
        const customerOrders = orders.filter(o => o.customerId === customer.id).length;
        const row = `
            <tr>
                <td>${customer.id}</td>
                <td>${customer.name}</td>
                <td>${customer.email}</td>
                <td>${customerOrders}</td>
                <td>
                    <button class="edit-btn" onclick="editCustomer(${customer.id})">Edit</button>
                    <button class="delete-btn" onclick="deleteCustomer(${customer.id})">Delete</button>
                </td>
            </tr>
        `;
        tbody.innerHTML += row;
    });
}

function addCustomer(event) {
    event.preventDefault();
    const name = document.getElementById('customer-name').value;
    const email = document.getElementById('customer-email').value;
    const newCustomer = {
        id: customers.length ? Math.max(...customers.map(c => c.id)) + 1 : 1,
        name,
        email
    };
    customers.push(newCustomer);
    localStorage.setItem('customers', JSON.stringify(customers));
    closeModal('add-customer-modal');
    renderCustomersTable();
    updateDashboardStats();
}

function editCustomer(id) {
    alert(`Edit customer ${id} - Implement edit functionality here.`);
    // Add edit modal or form logic here
}

function deleteCustomer(id) {
    if (confirm('Are you sure you want to delete this customer?')) {
        customers = customers.filter(customer => customer.id !== id);
        orders = orders.filter(order => order.customerId !== id);
        localStorage.setItem('customers', JSON.stringify(customers));
        localStorage.setItem('orders', JSON.stringify(orders));
        renderCustomersTable();
        renderOrdersTable();
        updateDashboardStats();
    }
}

// Populate Dropdowns
function populateCustomerDropdown() {
    const select = document.getElementById('order-customer');
    select.innerHTML = '';
    customers.forEach(customer => {
        const option = `<option value="${customer.id}">${customer.name}</option>`;
        select.innerHTML += option;
    });
}

function populateProductDropdown() {
    const select = document.getElementById('stock-product');
    select.innerHTML = '';
    products.forEach(product => {
        const option = `<option value="${product.id}">${product.name}</option>`;
        select.innerHTML += option;
    });
}

// Modal Functions
function openModal(modalId, productId = null) {
    const modal = document.getElementById(modalId);
    modal.style.display = 'block';
    if (modalId === 'update-stock-modal' && productId) {
        const product = products.find(p => p.id === productId);
        if (product) {
            document.getElementById('stock-product').value = product.id;
            document.getElementById('stock-quantity').value = product.stock;
        }
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = 'none';
    // Reset forms
    const form = modal.querySelector('form');
    if (form) form.reset();
}

// Table Sorting
function sortTable(tableId, colIndex) {
    const table = document.getElementById(tableId);
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const isNumeric = colIndex === 2 || colIndex === 3; // Adjust based on column data type
    let ascending = table.dataset.sortDirection !== 'asc';

    rows.sort((a, b) => {
        let aValue = a.cells[colIndex].textContent.trim();
        let bValue = b.cells[colIndex].textContent.trim();

        if (isNumeric) {
            aValue = parseFloat(aValue.replace('$', '')) || 0;
            bValue = parseFloat(bValue.replace('$', '')) || 0;
            return ascending ? aValue - bValue : bValue - aValue;
        } else {
            return ascending ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
        }
    });

    tbody.innerHTML = '';
    rows.forEach(row => tbody.appendChild(row));
    table.dataset.sortDirection = ascending ? 'asc' : 'desc';
}

// Dashboard Charts
let salesChart, customerChart, monthlySalesChart, topProductsChart;

function updateDashboardCharts() {
    // Sales Chart
    const salesData = orders.reduce((acc, order) => {
        const month = new Date(order.date).getMonth();
        acc[month] = (acc[month] || 0) + order.total;
        return acc;
    }, Array(12).fill(0));

    if (salesChart) salesChart.destroy();
    salesChart = new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Sales',
                data: salesData,
                borderColor: '#4a90e2',
                fill: false,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Customer Chart
    const customerData = customers.reduce((acc, customer) => {
        const month = new Date().getMonth();
        acc[month] = (acc[month] || 0) + 1;
        return acc;
    }, Array(12).fill(0));

    if (customerChart) customerChart.destroy();
    customerChart = new Chart(document.getElementById('customerChart'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'New Customers',
                data: customerData,
                backgroundColor: '#50c878'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
}

function updateChart(chartType) {
    if (chartType === 'sales') {
        updateDashboardCharts();
        alert('Sales chart refreshed!');
    } else if (chartType === 'customers') {
        updateDashboardCharts();
        alert('Customer chart refreshed!');
    }
}

// Sales Summary Charts
function updateSalesCharts() {
    // Monthly Sales Chart
    const monthlySalesData = orders.reduce((acc, order) => {
        const month = new Date(order.date).getMonth();
        acc[month] = (acc[month] || 0) + order.total;
        return acc;
    }, Array(12).fill(0));

    if (monthlySalesChart) monthlySalesChart.destroy();
    monthlySalesChart = new Chart(document.getElementById('monthlySalesChart'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Monthly Sales',
                data: monthlySalesData,
                backgroundColor: '#4a90e2'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Top Products Chart
    const productSales = products.map(product => {
        const totalSales = orders.reduce((sum, order) => {
            // Simplified: Assume each order might include this product (for demo purposes)
            return sum + (Math.random() * order.total); // Replace with actual product-order mapping
        }, 0);
        return { name: product.name, sales: totalSales };
    }).sort((a, b) => b.sales - a.sales).slice(0, 5);

    if (topProductsChart) topProductsChart.destroy();
    topProductsChart = new Chart(document.getElementById('topProductsChart'), {
        type: 'pie',
        data: {
            labels: productSales.map(p => p.name),
            datasets: [{
                label: 'Top Products',
                data: productSales.map(p => p.sales),
                backgroundColor: ['#4a90e2', '#50c878', '#e74c3c', '#f1c40f', '#9b59b6']
            }]
        },
        options: {
            responsive: true
        }
    });
}

function generateSalesReport() {
    const totalSales = orders.reduce((sum, order) => sum + order.total, 0).toFixed(2);
    alert(`Sales Report Generated!\nTotal Sales: $${totalSales}\nOrders: ${orders.length}`);
    // Add actual report generation logic here (e.g., download PDF)
}

// Initialize the dashboard
updateContent('dashboard');
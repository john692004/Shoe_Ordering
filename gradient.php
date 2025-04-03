<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dawn.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Dashboard</h2>
                <i class="fas fa-bars toggle-btn"></i>
            </div>
            <ul class="nav-list">
                <li class="nav-item" data-section="dashboard">
                    <a href="#"><i class="fas fa-home"></i> Dashboard Home</a>
                </li>
                <li class="nav-item" data-section="orders">
                    <a href="#"><i class="fas fa-shopping-cart"></i> Orders</a>
                </li>
                <li class="nav-item" data-section="products">
                    <a href="#"><i class="fas fa-box"></i> Products</a>
                </li>
                <li class="nav-item" data-section="stock">
                    <a href="#"><i class="fas fa-warehouse"></i> Stock</a>
                </li>
                <li class="nav-item" data-section="customers">
                    <a href="#"><i class="fas fa-users"></i> Customers</a>
                </li>
                <li class="nav-item" data-section="sales">
                    <a href="#"><i class="fas fa-chart-line"></i> Sales Summary</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <h1 id="page-title">Dashboard Home</h1>
                <div class="user-info">
                    <span>John Doe</span>
                    <i class="fas fa-user-circle user-icon" onclick="toggleUserMenu()"></i>
                    <div class="user-menu" id="user-menu">
                        <button onclick="alert('Profile clicked!')">Profile</button>
                        <button onclick="alert('Settings clicked!')">Settings</button>
                        <button onclick="logout()">Logout</button>
                    </div>
                </div>
            </div>

            <!-- Dashboard Home Section -->
            <div class="section" id="dashboard-section">
                <div class="stats-cards" id="stats-cards">
                    <div class="card">
                        <h3>Total Orders</h3>
                        <p id="total-orders">0</p>
                        <i class="fas fa-shopping-cart card-icon"></i>
                        <button class="card-btn" onclick="navigateToSection('orders')">View Orders</button>
                    </div>
                    <div class="card">
                        <h3>Revenue</h3>
                        <p id="revenue">$0</p>
                        <i class="fas fa-dollar-sign card-icon"></i>
                        <button class="card-btn" onclick="navigateToSection('sales')">View Sales</button>
                    </div>
                    <div class="card">
                        <h3>Customers</h3>
                        <p id="customers">0</p>
                        <i class="fas fa-users card-icon"></i>
                        <button class="card-btn" onclick="navigateToSection('customers')">View Customers</button>
                    </div>
                    <div class="card">
                        <h3>Stock Level</h3>
                        <p id="stock">0</p>
                        <i class="fas fa-warehouse card-icon"></i>
                        <button class="card-btn" onclick="navigateToSection('stock')">View Stock</button>
                    </div>
                </div>
                <div class="charts-section">
                    <div class="chart-card">
                        <h3>Sales Over Time</h3>
                        <canvas id="salesChart"></canvas>
                        <button class="chart-btn" onclick="updateChart('sales')">Refresh Chart</button>
                    </div>
                    <div class="chart-card">
                        <h3>Customer Growth</h3>
                        <canvas id="customerChart"></canvas>
                        <button class="chart-btn" onclick="updateChart('customers')">Refresh Chart</button>
                    </div>
                </div>
            </div>

            <!-- Orders Section -->
            <div class="section" id="orders-section" style="display: none;">
                <div class="section-header">
                    <h2>Orders</h2>
                    <button class="action-btn" onclick="openModal('add-order-modal')">Add New Order</button>
                </div>
                <table id="orders-table">
                    <thead>
                        <tr>
                            <th onclick="sortTable('orders-table', 0)">Order ID <i class="fas fa-sort"></i></th>
                            <th onclick="sortTable('orders-table', 1)">Customer <i class="fas fa-sort"></i></th>
                            <th onclick="sortTable('orders-table', 2)">Total <i class="fas fa-sort"></i></th>
                            <th onclick="sortTable('orders-table', 3)">Date <i class="fas fa-sort"></i></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="orders-table-body"></tbody>
                </table>
            </div>

            <!-- Products Section -->
            <div class="section" id="products-section" style="display: none;">
                <div class="section-header">
                    <h2>Products</h2>
                    <button class="action-btn" onclick="openModal('add-product-modal')">Add New Product</button>
                </div>
                <table id="products-table">
                    <thead>
                        <tr>
                            <th onclick="sortTable('products-table', 0)">Product ID <i class="fas fa-sort"></i></th>
                            <th onclick="sortTable('products-table', 1)">Name <i class="fas fa-sort"></i></th>
                            <th onclick="sortTable('products-table', 2)">Price <i class="fas fa-sort"></i></th>
                            <th onclick="sortTable('products-table', 3)">Stock <i class="fas fa-sort"></i></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="products-table-body"></tbody>
                </table>
            </div>

            <!-- Stock Section -->
            <div class="section" id="stock-section" style="display: none;">
                <div class="section-header">
                    <h2>Stock</h2>
                    <button class="action-btn" onclick="openModal('update-stock-modal')">Update Stock</button>
                </div>
                <table id="stock-table">
                    <thead>
                        <tr>
                            <th onclick="sortTable('stock-table', 0)">Product ID <i class="fas fa-sort"></i></th>
                            <th onclick="sortTable('stock-table', 1)">Name <i class="fas fa-sort"></i></th>
                            <th onclick="sortTable('stock-table', 2)">Stock Level <i class="fas fa-sort"></i></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="stock-table-body"></tbody>
                </table>
            </div>

            <!-- Customers Section -->
            <div class="section" id="customers-section" style="display: none;">
                <div class="section-header">
                    <h2>Customers</h2>
                    <button class="action-btn" onclick="openModal('add-customer-modal')">Add New Customer</button>
                </div>
                <table id="customers-table">
                    <thead>
                        <tr>
                            <th onclick="sortTable('customers-table', 0)">Customer ID <i class="fas fa-sort"></i></th>
                            <th onclick="sortTable('customers-table', 1)">Name <i class="fas fa-sort"></i></th>
                            <th onclick="sortTable('customers-table', 2)">Email <i class="fas fa-sort"></i></th>
                            <th onclick="sortTable('customers-table', 3)">Orders <i class="fas fa-sort"></i></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="customers-table-body"></tbody>
                </table>
            </div>

            <!-- Sales Summary Section -->
            <div class="section" id="sales-section" style="display: none;">
                <div class="section-header">
                    <h2>Sales Summary</h2>
                    <button class="action-btn" onclick="generateSalesReport()">Generate Report</button>
                </div>
                <div class="charts-section">
                    <div class="chart-card">
                        <h3>Monthly Sales</h3>
                        <canvas id="monthlySalesChart"></canvas>
                    </div>
                    <div class="chart-card">
                        <h3>Top Products</h3>
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Add Order Modal -->
    <div class="modal" id="add-order-modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('add-order-modal')">&times;</span>
            <h2>Add New Order</h2>
            <form id="add-order-form" onsubmit="addOrder(event)">
                <label for="order-customer">Customer:</label>
                <select id="order-customer" required></select>
                <label for="order-total">Total:</label>
                <input type="number" id="order-total" step="0.01" required>
                <label for="order-date">Date:</label>
                <input type="date" id="order-date" required>
                <button type="submit">Add Order</button>
            </form>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal" id="add-product-modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('add-product-modal')">&times;</span>
            <h2>Add New Product</h2>
            <form id="add-product-form" onsubmit="addProduct(event)">
                <label for="product-name">Name:</label>
                <input type="text" id="product-name" required>
                <label for="product-price">Price:</label>
                <input type="number" id="product-price" step="0.01" required>
                <label for="product-stock">Stock:</label>
                <input type="number" id="product-stock" required>
                <button type="submit">Add Product</button>
            </form>
        </div>
    </div>

    <!-- Update Stock Modal -->
    <div class="modal" id="update-stock-modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('update-stock-modal')">&times;</span>
            <h2>Update Stock</h2>
            <form id="update-stock-form" onsubmit="updateStock(event)">
                <label for="stock-product">Product:</label>
                <select id="stock-product" required></select>
                <label for="stock-quantity">Quantity:</label>
                <input type="number" id="stock-quantity" required>
                <button type="submit">Update Stock</button>
            </form>
        </div>
    </div>

    <!-- Add Customer Modal -->
    <div class="modal" id="add-customer-modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('add-customer-modal')">&times;</span>
            <h2>Add New Customer</h2>
            <form id="add-customer-form" onsubmit="addCustomer(event)">
                <label for="customer-name">Name:</label>
                <input type="text" id="customer-name" required>
                <label for="customer-email">Email:</label>
                <input type="email" id="customer-email" required>
                <button type="submit">Add Customer</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="javascript.js"></script>
</body>
</html>
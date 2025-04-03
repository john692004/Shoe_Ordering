<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #3f37c9;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --gray-light: #e9ecef;
            --success: #4cc9f0;
            --warning: #f8961e;
            --danger: #f72585;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f5f7fb;
            color: var(--dark);
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            z-index: 1000;
            height: 100vh;
            position: fixed;
        }

        .sidebar.collapsed {
            width: 70px;
            overflow: hidden;
        }

        .sidebar.collapsed .sidebar-header h3, 
        .sidebar.collapsed .sidebar-menu h4,
        .sidebar.collapsed .sidebar-menu li a span {
            display: none;
        }

        .sidebar.collapsed .sidebar-menu li a {
            justify-content: center;
            padding: 15px 0;
        }

        .sidebar.collapsed .sidebar-menu li a i {
            margin-right: 0;
            font-size: 1.2rem;
        }

        .sidebar-header {
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--gray-light);
        }

        .sidebar-header h3 {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.3rem;
        }

        .sidebar-header i {
            cursor: pointer;
            color: var(--gray);
        }

        .sidebar-menu {
            padding: 20px 0;
            height: calc(100vh - 70px);
            overflow-y: auto;
        }

        .sidebar-menu h4 {
            color: var(--gray);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0 20px 10px;
            font-weight: 600;
        }

        .sidebar-menu ul {
            list-style: none;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.2s;
            font-weight: 500;
        }

        .sidebar-menu li a:hover {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary);
        }

        .sidebar-menu li a.active {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            border-left: 3px solid var(--primary);
        }

        .sidebar-menu li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
        }

        .main-content.collapsed {
            margin-left: 70px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            margin-bottom: 20px;
        }

        .header h2 {
            font-weight: 600;
            color: var(--dark);
        }

        .user-menu {
            display: flex;
            align-items: center;
        }

        .user-menu .notification {
            position: relative;
            margin-right: 20px;
            color: var(--gray);
            cursor: pointer;
        }

        .user-menu .notification .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--danger);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-menu .user-profile {
            display: flex;
            align-items: center;
            cursor: pointer;
            position: relative;
        }

        .user-menu .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }

        .user-menu .user-profile .user-info h5 {
            font-size: 0.9rem;
            margin-bottom: 2px;
        }

        .user-menu .user-profile .user-info p {
            font-size: 0.7rem;
            color: var(--gray);
        }

        .user-menu .dropdown-menu {
            position: absolute;
            top: 50px;
            right: 0;
            background: white;
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 200px;
            z-index: 100;
            display: none;
        }

        .user-menu .dropdown-menu.show {
            display: block;
        }

        .user-menu .dropdown-menu a {
            display: block;
            padding: 10px 15px;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.2s;
        }

        .user-menu .dropdown-menu a:hover {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary);
        }

        .user-menu .dropdown-menu a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Dashboard Cards */
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .card-header h4 {
            font-size: 0.9rem;
            color: var(--gray);
            font-weight: 500;
        }

        .card-header i {
            font-size: 1.2rem;
            color: var(--gray);
        }

        .card-body h3 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .card-body p {
            font-size: 0.8rem;
            color: var(--gray);
        }

        .card-body p span {
            color: var(--success);
            font-weight: 600;
        }

        /* Charts Section */
        .chart-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .chart-container {
                grid-template-columns: 1fr;
            }
        }

        .chart-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .chart-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-card-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .chart-card-header .chart-filter {
            display: flex;
            gap: 10px;
        }

        .chart-card-header .chart-filter button {
            background: none;
            border: 1px solid var(--gray-light);
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .chart-card-header .chart-filter button.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .chart-card-header .chart-filter button:hover {
            background: var(--gray-light);
        }

        .chart-wrapper {
            position: relative;
            height: 300px;
            width: 100%;
        }

        /* Recent Orders Table */
        .table-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow-x: auto;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .table-header button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .table-header button:hover {
            background: var(--primary-dark);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead th {
            text-align: left;
            padding: 10px 0;
            border-bottom: 1px solid var(--gray-light);
            color: var(--gray);
            font-weight: 500;
            font-size: 0.8rem;
        }

        table tbody tr {
            border-bottom: 1px solid var(--gray-light);
            transition: all 0.2s;
        }

        table tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        table tbody td {
            padding: 15px 0;
            font-size: 0.9rem;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 500;
        }

        .status.completed {
            background-color: rgba(76, 201, 240, 0.1);
            color: var(--success);
        }

        .status.pending {
            background-color: rgba(248, 150, 30, 0.1);
            color: var(--warning);
        }

        .status.canceled {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--danger);
        }

        .action-btn {
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
            margin-right: 10px;
            transition: all 0.2s;
        }

        .action-btn:hover {
            color: var(--primary);
        }

        /* Notification Dropdown */
        .notification-dropdown {
            position: absolute;
            top: 50px;
            right: 0;
            background: white;
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 300px;
            z-index: 100;
            display: none;
        }

        .notification-dropdown.show {
            display: block;
        }

        .notification-header {
            padding: 15px;
            border-bottom: 1px solid var(--gray-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-header h4 {
            font-size: 0.9rem;
            font-weight: 600;
        }

        .notification-header a {
            font-size: 0.8rem;
            color: var(--primary);
            text-decoration: none;
        }

        .notification-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .notification-item {
            padding: 15px;
            border-bottom: 1px solid var(--gray-light);
            transition: all 0.2s;
        }

        .notification-item:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .notification-item.unread {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .notification-item .notification-content {
            display: flex;
            align-items: flex-start;
        }

        .notification-item .notification-content i {
            margin-right: 10px;
            color: var(--primary);
            font-size: 1rem;
        }

        .notification-item .notification-text {
            flex: 1;
        }

        .notification-item .notification-text p {
            font-size: 0.8rem;
            margin-bottom: 5px;
        }

        .notification-item .notification-time {
            font-size: 0.7rem;
            color: var(--gray);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background-color: white;
            border-radius: 10px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            padding: 15px 20px;
            border-bottom: 1px solid var(--gray-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .modal-header .close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray);
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid var(--gray-light);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .modal-footer button {
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .modal-footer button.btn-primary {
            background: var(--primary);
            color: white;
            border: none;
        }

        .modal-footer button.btn-primary:hover {
            background: var(--primary-dark);
        }

        .modal-footer button.btn-secondary {
            background: none;
            border: 1px solid var(--gray-light);
            color: var(--dark);
        }

        .modal-footer button.btn-secondary:hover {
            background: var(--gray-light);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--gray-light);
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .card-container {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 576px) {
            .card-container {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .user-menu {
                margin-top: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Admin Panel</h3>
            <i class="fas fa-bars toggle-sidebar"></i>
        </div>
        <div class="sidebar-menu">
            <h4>Main</h4>
            <ul>
                <li><a href="#" class="active" data-page="dashboard"><i class="fas fa-home"></i> <span>Dashboard Home</span></a></li>
                <li><a href="#" data-page="orders"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a></li>
                <li><a href="#" data-page="products"><i class="fas fa-box-open"></i> <span>Products</span></a></li>
                <li><a href="#" data-page="stock"><i class="fas fa-warehouse"></i> <span>Stock</span></a></li>
                <li><a href="#" data-page="customers"><i class="fas fa-users"></i> <span>Customers</span></a></li>
                <li><a href="#" data-page="sales"><i class="fas fa-chart-line"></i> <span>Sales Summary</span></a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h2 class="page-title">Dashboard Overview</h2>
            <div class="user-menu">
                <div class="notification">
                    <i class="fas fa-bell notification-icon"></i>
                    <span class="badge">3</span>
                    <div class="notification-dropdown">
                        <div class="notification-header">
                            <h4>Notifications</h4>
                            <a href="#">Mark all as read</a>
                        </div>
                        <div class="notification-list">
                            <div class="notification-item unread">
                                <div class="notification-content">
                                    <i class="fas fa-shopping-cart"></i>
                                    <div class="notification-text">
                                        <p><strong>New order received</strong> from John Doe</p>
                                        <p class="notification-time">2 minutes ago</p>
                                    </div>
                                </div>
                            </div>
                            <div class="notification-item unread">
                                <div class="notification-content">
                                    <i class="fas fa-user-plus"></i>
                                    <div class="notification-text">
                                        <p><strong>New customer registered</strong> - Sarah Johnson</p>
                                        <p class="notification-time">1 hour ago</p>
                                    </div>
                                </div>
                            </div>
                            <div class="notification-item">
                                <div class="notification-content">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <div class="notification-text">
                                        <p><strong>Low stock alert</strong> for Product #1234</p>
                                        <p class="notification-time">3 hours ago</p>
                                    </div>
                                </div>
                            </div>
                            <div class="notification-item">
                                <div class="notification-content">
                                    <i class="fas fa-check-circle"></i>
                                    <div class="notification-text">
                                        <p><strong>Order #4567</strong> has been shipped</p>
                                        <p class="notification-time">Yesterday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user-profile">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                    <div class="user-info">
                        <h5>John Doe</h5>
                        <p>Admin</p>
                    </div>
                    <div class="dropdown-menu">
                        <a href="#"><i class="fas fa-user"></i> Profile</a>
                        <a href="#"><i class="fas fa-cog"></i> Settings</a>
                        <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="page-content" id="dashboard-page">
            <!-- Dashboard Cards -->
            <div class="card-container">
                <div class="card">
                    <div class="card-header">
                        <h4>Total Revenue</h4>
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-body">
                        <h3>$24,780</h3>
                        <p><span>+12.5%</span> from last month</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Total Orders</h4>
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-body">
                        <h3>1,248</h3>
                        <p><span>+8.2%</span> from last month</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Products</h4>
                        <i class="fas fa-box-open"></i>
                    </div>
                    <div class="card-body">
                        <h3>356</h3>
                        <p><span>+5.3%</span> new products</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Customers</h4>
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-body">
                        <h3>8,542</h3>
                        <p><span>+3.1%</span> new customers</p>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="chart-container">
                <div class="chart-card">
                    <div class="chart-card-header">
                        <h3>Sales Overview</h3>
                        <div class="chart-filter">
                            <button class="active" data-period="week">Week</button>
                            <button data-period="month">Month</button>
                            <button data-period="year">Year</button>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <div class="chart-card-header">
                        <h3>Revenue Sources</h3>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3>Recent Orders</h3>
                    <button class="view-all-orders">View All</button>
                </div>
                <table id="ordersTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#ORD-7841</td>
                            <td>Sarah Johnson</td>
                            <td>May 15, 2023</td>
                            <td>$245.00</td>
                            <td><span class="status completed">Completed</span></td>
                            <td>
                                <button class="action-btn view-order"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit-order"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-order"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-7840</td>
                            <td>Michael Brown</td>
                            <td>May 14, 2023</td>
                            <td>$189.50</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <button class="action-btn view-order"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit-order"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-order"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-7839</td>
                            <td>Emily Davis</td>
                            <td>May 14, 2023</td>
                            <td>$320.75</td>
                            <td><span class="status completed">Completed</span></td>
                            <td>
                                <button class="action-btn view-order"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit-order"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-order"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-7838</td>
                            <td>Robert Wilson</td>
                            <td>May 13, 2023</td>
                            <td>$145.20</td>
                            <td><span class="status canceled">Canceled</span></td>
                            <td>
                                <button class="action-btn view-order"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit-order"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-order"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-7837</td>
                            <td>Jennifer Lee</td>
                            <td>May 12, 2023</td>
                            <td>$275.90</td>
                            <td><span class="status completed">Completed</span></td>
                            <td>
                                <button class="action-btn view-order"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit-order"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-order"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Orders Page (Hidden by default) -->
        <div class="page-content" id="orders-page" style="display: none;">
            <div class="table-container">
                <div class="table-header">
                    <h3>All Orders</h3>
                    <button class="add-order">Add New Order</button>
                </div>
                <table id="allOrdersTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#ORD-7841</td>
                            <td>Sarah Johnson</td>
                            <td>May 15, 2023</td>
                            <td>3</td>
                            <td>$245.00</td>
                            <td><span class="status completed">Completed</span></td>
                            <td>
                                <button class="action-btn view-order"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit-order"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-order"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-7840</td>
                            <td>Michael Brown</td>
                            <td>May 14, 2023</td>
                            <td>2</td>
                            <td>$189.50</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <button class="action-btn view-order"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit-order"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-order"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-7839</td>
                            <td>Emily Davis</td>
                            <td>May 14, 2023</td>
                            <td>5</td>
                            <td>$320.75</td>
                            <td><span class="status completed">Completed</span></td>
                            <td>
                                <button class="action-btn view-order"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit-order"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-order"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-7838</td>
                            <td>Robert Wilson</td>
                            <td>May 13, 2023</td>
                            <td>1</td>
                            <td>$145.20</td>
                            <td><span class="status canceled">Canceled</span></td>
                            <td>
                                <button class="action-btn view-order"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit-order"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-order"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-7837</td>
                            <td>Jennifer Lee</td>
                            <td>May 12, 2023</td>
                            <td>4</td>
                            <td>$275.90</td>
                            <td><span class="status completed">Completed</span></td>
                            <td>
                                <button class="action-btn view-order"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit-order"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-order"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-7836</td>
                            <td>David Miller</td>
                            <td>May 11, 2023</td>
                            <td>2</td>
                            <td>$198.00</td>
                            <td><span class="status completed">Completed</span></td>
                            <td>
                                <button class="action-btn view-order"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit-order"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-order"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-7835</td>
                            <td>Lisa Taylor</td>
                            <td>May 10, 2023</td>
                            <td>3</td>
                            <td>$225.50</td>
                            <td><span class="status completed">Completed</span></td>
                            <td>
                                <button class="action-btn view-order"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit-order"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-order"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Products Page (Hidden by default) -->
        <div class="page-content" id="products-page" style="display: none;">
            <div class="table-container">
                <div class="table-header">
                    <h3>Products</h3>
                    <button class="add-product">Add New Product</button>
                </div>
                <table id="productsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#PRD-1001</td>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <img src="https://via.placeholder.com/40" alt="Product" style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px; border-radius: 5px;">
                                    <span>Wireless Headphones</span>
                                </div>
                            </td>
                            <td>Electronics</td>
                            <td>$99.99</td>
                            <td>45</td>
                            <td><span class="status completed">In Stock</span></td>
                            <td>
                                <button class="action-btn view-product"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit-product"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-product"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#PRD-1002</td>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <img src="https://via.placeholder.com/40" alt="Product" style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px; border-radius: 5px;">
                                    <span>Smart Watch</span>
                                </div>
                            </td>
                            <td>Electronics</td>
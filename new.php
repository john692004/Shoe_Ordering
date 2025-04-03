<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #6366f1;
            --primary-dark: #4338ca;
            --secondary: #7c3aed;
            --dark: #1e293b;
            --dark-light: #334155;
            --light: #f8fafc;
            --gray: #94a3b8;
            --gray-light: #e2e8f0;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --sidebar-width: 240px;
            --sidebar-collapsed-width: 80px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f1f5f9;
            color: var(--dark);
            overflow-x: hidden;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            transition: all 0.3s ease;
            z-index: 100;
        }
        
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-light);
            height: 70px;
            display: flex;
            align-items: center;
        }
        
        .sidebar-header h2 {
            color: var(--primary);
            font-size: 1.25rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            white-space: nowrap;
        }
        
        .sidebar-header h2 i {
            font-size: 1.5rem;
        }
        
        .sidebar-menu {
            padding: 1rem 0;
            overflow-y: auto;
            height: calc(100vh - 70px);
        }
        
        .sidebar-menu h3 {
            font-size: 0.6875rem;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: 0.75rem;
            padding: 0 1.5rem;
            letter-spacing: 0.5px;
            font-weight: 600;
        }
        
        .sidebar-menu ul {
            list-style: none;
            margin-bottom: 1.5rem;
        }
        
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            color: var(--dark-light);
            text-decoration: none;
            border-radius: 0;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.9375rem;
            position: relative;
            white-space: nowrap;
        }
        
        .sidebar-menu li a:hover {
            background-color: var(--gray-light);
            color: var(--primary);
        }
        
        .sidebar-menu li a.active {
            background-color: rgba(79, 70, 229, 0.1);
            color: var(--primary);
            font-weight: 600;
        }
        
        .sidebar-menu li a.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: var(--primary);
        }
        
        .sidebar-menu li a i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }
        
        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 1.5rem;
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
        }
        
        /* Top Navigation */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .search-bar {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            width: 300px;
            transition: all 0.3s ease;
        }
        
        .search-bar:focus-within {
            box-shadow: 0 0 0 2px var(--primary-light);
        }
        
        .search-bar input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            padding: 0.25rem;
            font-size: 0.875rem;
        }
        
        .search-bar i {
            color: var(--gray);
            margin-right: 0.5rem;
            font-size: 0.9375rem;
        }
        
        .user-actions {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }
        
        .notification {
            position: relative;
            color: var(--dark-light);
            cursor: pointer;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            font-weight: bold;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
        }
        
        .user-profile img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--gray-light);
        }
        
        .user-profile .user-info {
            line-height: 1.2;
        }
        
        .user-profile .user-info .name {
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        .user-profile .user-info .role {
            font-size: 0.75rem;
            color: var(--gray);
        }
        
        /* Dashboard Content */
        .dashboard-content {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 1.25rem;
        }
        
        .welcome-banner {
            grid-column: span 12;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 2rem;
            border-radius: 0.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .welcome-banner::after {
            content: '';
            position: absolute;
            bottom: -80px;
            right: -80px;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }
        
        .welcome-text h1 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }
        
        .welcome-text p {
            opacity: 0.9;
            margin-bottom: 1.25rem;
            font-size: 0.9375rem;
            position: relative;
            z-index: 1;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            outline: none;
            font-size: 0.875rem;
            position: relative;
            z-index: 1;
        }
        
        .btn-primary {
            background: white;
            color: var(--primary);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .welcome-image {
            position: relative;
            z-index: 1;
        }
        
        .welcome-image i {
            font-size: 4rem;
            opacity: 0.2;
        }
        
        .stats-cards {
            grid-column: span 12;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
        }
        
        .card {
            background: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card {
            display: flex;
            flex-direction: column;
        }
        
        .stat-card .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        
        .stat-card .card-header .icon {
            width: 44px;
            height: 44px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        
        .stat-card .card-header .icon.orders {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }
        
        .stat-card .card-header .icon.products {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }
        
        .stat-card .card-header .icon.stock {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }
        
        .stat-card .card-header .icon.customers {
            background: rgba(168, 85, 247, 0.1);
            color: #a855f7;
        }
        
        .stat-card .value {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        
        .stat-card .label {
            color: var(--gray);
            font-size: 0.8125rem;
            font-weight: 500;
        }
        
        .stat-card .trend {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin-top: 0.75rem;
            font-size: 0.8125rem;
            font-weight: 500;
        }
        
        .stat-card .trend i {
            font-size: 0.75rem;
        }
        
        .stat-card .trend.up {
            color: var(--success);
        }
        
        .stat-card .trend.down {
            color: var(--danger);
        }
        
        .main-cards {
            grid-column: span 8;
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.25rem;
        }
        
        .chart-card {
            min-height: 350px;
        }
        
        .chart-card .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .chart-card .card-header h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--dark);
        }
        
        .chart-card .card-header .actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .chart-card .card-header .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--gray-light);
            color: var(--dark);
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.875rem;
        }
        
        .chart-card .card-header .btn-icon:hover {
            background: var(--gray);
            color: white;
        }
        
        .chart-placeholder {
            background: #f8fafc;
            border-radius: 0.5rem;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray);
            border: 1px dashed var(--gray-light);
        }
        
        .side-cards {
            grid-column: span 4;
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.25rem;
        }
        
        .recent-orders .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--gray-light);
        }
        
        .recent-orders .order-item:last-child {
            border-bottom: none;
        }
        
        .recent-orders .order-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .recent-orders .order-info .product-image {
            width: 36px;
            height: 36px;
            border-radius: 0.5rem;
            background: var(--gray-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray);
            font-size: 0.875rem;
        }
        
        .recent-orders .order-details .order-id {
            font-weight: 600;
            font-size: 0.8125rem;
            margin-bottom: 0.25rem;
            color: var(--dark);
        }
        
        .recent-orders .order-details .customer {
            font-size: 0.75rem;
            color: var(--gray);
        }
        
        .recent-orders .order-amount {
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--dark);
        }
        
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
            font-size: 0.6875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-badge.completed {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }
        
        .status-badge.processing {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }
        
        .status-badge.pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }
        
        .status-badge.cancelled {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }
        
        .top-products .product-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--gray-light);
        }
        
        .top-products .product-item:last-child {
            border-bottom: none;
        }
        
        .top-products .product-rank {
            font-weight: 700;
            color: var(--gray);
            width: 20px;
            text-align: center;
            font-size: 0.8125rem;
        }
        
        .top-products .product-image {
            width: 36px;
            height: 36px;
            border-radius: 0.5rem;
            background: var(--gray-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray);
            font-size: 0.875rem;
        }
        
        .top-products .product-info {
            flex: 1;
        }
        
        .top-products .product-name {
            font-weight: 600;
            font-size: 0.8125rem;
            margin-bottom: 0.25rem;
            color: var(--dark);
        }
        
        .top-products .product-sales {
            font-size: 0.75rem;
            color: var(--gray);
        }
        
        .top-products .product-revenue {
            font-weight: 600;
            font-size: 0.8125rem;
            color: var(--dark);
        }
        
        .recent-activity .activity-item {
            display: flex;
            gap: 0.75rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--gray-light);
        }
        
        .recent-activity .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--gray-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray);
            flex-shrink: 0;
            font-size: 0.875rem;
        }
        
        .activity-details {
            flex: 1;
        }
        
        .activity-message {
            font-size: 0.8125rem;
            margin-bottom: 0.25rem;
            color: var(--dark);
        }
        
        .activity-message strong {
            font-weight: 600;
        }
        
        .activity-time {
            font-size: 0.75rem;
            color: var(--gray);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .card-header h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--dark);
        }
        
        .card-header .view-all {
            font-size: 0.8125rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .card-header .view-all:hover {
            text-decoration: underline;
        }
        
        /* Toggle Sidebar Button */
        .toggle-sidebar {
            display: none;
            background: none;
            border: none;
            color: var(--dark);
            font-size: 1.25rem;
            cursor: pointer;
            margin-right: 1rem;
        }
        
        /* Responsive Styles */
        @media (max-width: 1200px) {
            .stats-cards {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .main-cards {
                grid-column: span 12;
            }
            
            .side-cards {
                grid-column: span 12;
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .toggle-sidebar {
                display: block;
            }
        }
        
        @media (max-width: 768px) {
            .stats-cards {
                grid-template-columns: 1fr;
            }
            
            .side-cards {
                grid-template-columns: 1fr;
            }
            
            .search-bar {
                width: 200px;
            }
        }
        
        @media (max-width: 576px) {
            .top-nav {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
                padding: 1rem;
            }
            
            .search-bar {
                width: 100%;
            }
            
            .user-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .welcome-banner {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
            }
            
            .welcome-text {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2><i class="fas fa-store"></i> <span>Admin Dashboard</span></h2>
        </div>
        
        <div class="sidebar-menu">
            <h3>Main Menu</h3>
            <ul>
                <li><a href="#" class="active"><i class="fas fa-home"></i> <span>Home</span></a></li>
                <li><a href="#"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a></li>
                <li><a href="#"><i class="fas fa-box-open"></i> <span>Products</span></a></li>
                <li><a href="#"><i class="fas fa-warehouse"></i> <span>Stocks</span></a></li>
                <li><a href="#"><i class="fas fa-users"></i> <span>Customers</span></a></li>
                <li><a href="#"><i class="fas fa-chart-line"></i> <span>Sales Summary</span></a></li>
            </ul>
        </div>
    </aside>
    
    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Navigation -->
        <nav class="top-nav">
            <button class="toggle-sidebar">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search...">
            </div>
            
            <div class="user-actions">
                <div class="notification">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </div>
                <div class="user-profile">
                    <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp" alt="User">
                    <div class="user-info">
                        <div class="name">John Doe</div>
                        <div class="role">Administrator</div>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <div class="welcome-text">
                    <h1>Welcome back, Admin!</h1>
                    <p>Here's what's happening with your business today.</p>
                  
                </div>
                <div class="welcome-image">
                    <i class="fas fa-chart-pie"></i>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="stats-cards">
                <div class="card stat-card">
                    <div class="card-header">
                        <div>
                            <div class="value">1,254</div>
                            <div class="label">Total Orders</div>
                        </div>
                        <div class="icon orders">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                    <div class="trend up">
                        <i class="fas fa-arrow-up"></i> 12.5% from last month
                    </div>
                </div>
                
                <div class="card stat-card">
                    <div class="card-header">
                        <div>
                            <div class="value">568</div>
                            <div class="label">Total Products</div>
                        </div>
                        <div class="icon products">
                            <i class="fas fa-box-open"></i>
                        </div>
                    </div>
                    <div class="trend up">
                        <i class="fas fa-arrow-up"></i> 5.3% from last month
                    </div>
                </div>
                
                <div class="card stat-card">
                    <div class="card-header">
                        <div>
                            <div class="value">2,156</div>
                            <div class="label">Total Customers</div>
                        </div>
                        <div class="icon customers">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="trend up">
                        <i class="fas fa-arrow-up"></i> 8.1% from last month
                    </div>
                </div>
                
                <div class="card stat-card">
                    <div class="card-header">
                        <div>
                            <div class="value">$24,589</div>
                            <div class="label">Total Revenue</div>
                        </div>
                        <div class="icon stock">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="trend down">
                        <i class="fas fa-arrow-down"></i> 2.4% from last month
                    </div>
                </div>
            </div>
            
            <!-- Main Cards (Charts) -->
            <div class="main-cards">
                <div class="card chart-card">
                    <div class="card-header">
                        <h3>Sales Overview</h3>
                        <div class="actions">
                            <button class="btn-icon">
                                <i class="fas fa-calendar"></i>
                            </button>
                            <button class="btn-icon">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>
                    <div class="chart-placeholder">
                        <span>Sales Chart Will Appear Here</span>
                    </div>
                </div>
                
                <div class="card chart-card">
                    <div class="card-header">
                        <h3>Recent Orders</h3>
                        <a href="#" class="view-all">View All</a>
                    </div>
                    <div class="recent-orders">
                        <div class="order-item">
                            <div class="order-info">
                                <div class="product-image">
                                    <i class="fas fa-tshirt"></i>
                                </div>
                                <div class="order-details">
                                    <div class="order-id">#ORD-2023-001</div>
                                    <div class="customer">Michael Brown</div>
                                </div>
                            </div>
                            <div>
                                <span class="status-badge completed">Completed</span>
                                <div class="order-amount">$129.99</div>
                            </div>
                        </div>
                        
                        <div class="order-item">
                            <div class="order-info">
                                <div class="product-image">
                                    <i class="fas fa-laptop"></i>
                                </div>
                                <div class="order-details">
                                    <div class="order-id">#ORD-2023-002</div>
                                    <div class="customer">Sarah Johnson</div>
                                </div>
                            </div>
                            <div>
                                <span class="status-badge processing">Processing</span>
                                <div class="order-amount">$899.99</div>
                            </div>
                        </div>
                        
                        <div class="order-item">
                            <div class="order-info">
                                <div class="product-image">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div class="order-details">
                                    <div class="order-id">#ORD-2023-003</div>
                                    <div class="customer">David Wilson</div>
                                </div>
                            </div>
                            <div>
                                <span class="status-badge completed">Completed</span>
                                <div class="order-amount">$24.99</div>
                            </div>
                        </div>
                        
                        <div class="order-item">
                            <div class="order-info">
                                <div class="product-image">
                                    <i class="fas fa-headphones"></i>
                                </div>
                                <div class="order-details">
                                    <div class="order-id">#ORD-2023-004</div>
                                    <div class="customer">Emily Davis</div>
                                </div>
                            </div>
                            <div>
                                <span class="status-badge cancelled">Cancelled</span>
                                <div class="order-amount">$59.99</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Side Cards -->
            <div class="side-cards">
                <div class="card">
                    <div class="card-header">
                        <h3>Top Products</h3>
                        <a href="#" class="view-all">View All</a>
                    </div>
                    <div class="top-products">
                        <div class="product-item">
                            <div class="product-rank">1</div>
                            <div class="product-image">
                                <i class="fas fa-laptop"></i>
                            </div>
                            <div class="product-info">
                                <div class="product-name">Premium Laptop</div>
                                <div class="product-sales">128 sales this month</div>
                            </div>
                            <div class="product-revenue">$12,800</div>
                        </div>
                        
                        <div class="product-item">
                            <div class="product-rank">2</div>
                            <div class="product-image">
                                <i class="fas fa-tshirt"></i>
                            </div>
                            <div class="product-info">
                                <div class="product-name">Designer T-Shirt</div>
                                <div class="product-sales">89 sales this month</div>
                            </div>
                            <div class="product-revenue">$2,849</div>
                        </div>
                        
                        <div class="product-item">
                            <div class="product-rank">3</div>
                            <div class="product-image">
                                <i class="fas fa-headphones"></i>
                            </div>
                            <div class="product-info">
                                <div class="product-name">Wireless Headphones</div>
                                <div class="product-sales">76 sales this month</div>
                            </div>
                            <div class="product-revenue">$4,560</div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h3>Recent Activity</h3>
                        <a href="#" class="view-all">View All</a>
                    </div>
                    <div class="recent-activity">
                        <div class="activity-item">
                            <div class="activity-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="activity-details">
                                <div class="activity-message">
                                    <strong>Michael Brown</strong> placed a new order #ORD-2023-005
                                </div>
                                <div class="activity-time">5 minutes ago</div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="activity-details">
                                <div class="activity-message">
                                    New product <strong>"Wireless Earbuds"</strong> was added
                                </div>
                                <div class="activity-time">2 hours ago</div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="activity-details">
                                <div class="activity-message">
                                    Order <strong>#ORD-2023-004</strong> was cancelled
                                </div>
                                <div class="activity-time">5 hours ago</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        // Toggle sidebar on mobile
        document.querySelector('.toggle-sidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
        
        // Set active state for sidebar links
        document.querySelectorAll('.sidebar-menu li a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector('.sidebar-menu li a.active').classList.remove('active');
                this.classList.add('active');
                
                // Close sidebar on mobile after selection
                if (window.innerWidth < 992) {
                    document.querySelector('.sidebar').classList.remove('active');
                }
            });
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 992) {
                const sidebar = document.querySelector('.sidebar');
                const toggleBtn = document.querySelector('.toggle-sidebar');
                
                if (!sidebar.contains(e.target) && e.target !== toggleBtn && !toggleBtn.contains(e.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });
        
        // In a real implementation, you would add chart libraries here (Chart.js, etc.)
        // Example for Chart.js:
        /*
        const salesChart = new Chart(document.getElementById('sales-chart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Sales',
                    data: [12000, 19000, 15000, 18000, 22000, 25000],
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
        */
    </script>
</body>
</html>
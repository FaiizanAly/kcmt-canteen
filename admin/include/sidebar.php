<style>
            nav.sidebar.d-flex.flex-column.p-3 {
                box-shadow: 0px 0px 15px;
            }

            .sidebar {
                height: 100vh;
                background-color: #f8f9fa;
                padding-top: 20px;
            }

            .sidebar .nav-link {
                color: #333;
            }

            .sidebar .nav-link.active {
                background-color: #007bff;
                color: white;
            }

            .sidebar .dropdown-menu {
                width: 100%;
            }

            .card {
                box-shadow: 0px 0px 19px 2px;
            }
        </style>
<nav class="sidebar d-flex flex-column p-3 ">
                    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                        <h1 class="navbar-brand text-warning">KCMT CANTEEN</h1>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link ">
                                <i class="fas fa-home me-2"></i> Deshboard
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="all_users.php" class="nav-link " >
                                <i class="fas fa-users me-2"></i> Users
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="ordersDropdown" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-shopping-cart me-2"></i> Orders
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="ordersDropdown">
                                <li><a class="dropdown-item" href="all_orders.php">All Orders</a></li>
                                <li><a class="dropdown-item" href="pending.php">Pending Orders</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="productsDropdown" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-box me-2"></i> Products
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                                <li><a class="dropdown-item" href="all_menu.php">All Products</a></li>
                                <li><a class="dropdown-item" href="add_menu.php">Add Product</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                    <hr>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user fa-fw"></i> User
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                        </ul>
                    </div>
                </nav>
<nav class="navbar navbar-expand-lg navbar-light rounded-0 mb-2"
    style="
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
          ">
    <div class="container-fluid px-4">
        <!-- Mobile toggle button -->
        <button class="btn btn-link d-lg-none p-1 me-2" id="mobileToggleBtn" style="color: var(--text-color)">
            <i class="bi bi-list fs-4"></i>
        </button>

        <!-- Brand/logo -->
        <a class="navbar-brand d-none d-lg-block me-4" href="#" style="font-weight: 600">
            <i class="bi bi-shop me-2"></i>E-Commerce Dashboard
        </a>

        <!-- Spacer to push items to right -->
        <div class="d-flex flex-grow-1"></div>

        <!-- Right side elements -->
        <div class="d-flex align-items-center">
            <!-- Search bar -->
            <div class="input-group me-3 d-none d-lg-flex" style="width: 250px">
                <input type="text" class="form-control form-control-sm" placeholder="Search..."
                    style="
                    background-color: var(--bg-color);
                    border-color: var(--border-color);
                    color: var(--text-color);
                  " />
                <button class="btn btn-sm" type="button"
                    style="
                    background-color: var(--bg-color);
                    border-color: var(--border-color);
                    color: var(--text-color);
                  ">
                    <i class="bi bi-search"></i>
                </button>
            </div>

            <!-- Theme toggle -->
            <button class="btn btn-link p-2 me-1" id="themeToggle" style="color: var(--text-color)">
                <i class="bi fs-5" id="themeIcon"></i>
            </button>

            <!-- Notifications dropdown -->
            <div class="header-dropdown me-2">
                <button class="btn btn-link position-relative p-2" onclick="toggleDropdown('notificationsDropdown')"
                    style="color: var(--text-color)">
                    <i class="bi bi-bell fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        style="font-size: 0.5rem; padding: 0.2em 0.4em">
                        3
                    </span>
                </button>
                <ul class="header-dropdown-menu" id="notificationsDropdown" style="width: 320px; right: 0; left: auto">
                    <li>
                        <h6 class="header-dropdown-item px-3 pt-3 pb-2 mb-0 d-flex justify-content-between align-items-center border-bottom"
                            style="border-color: var(--border-color)">
                            <span>Notifications</span>
                            <small><a href="#" class="text-primary">Mark all as read</a></small>
                        </h6>
                    </li>
                    <li>
                        <a class="header-dropdown-item px-3 py-2 d-flex border-bottom" href="#"
                            style="border-color: var(--border-color)">
                            <div class="me-3 text-primary">
                                <i class="bi bi-cart-check fs-5"></i>
                            </div>
                            <div>
                                <div class="fw-medium">New order received</div>
                                <small class="text-muted">Order #EC-5421 for $245.00</small>
                                <div class="text-muted small">2 minutes ago</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="header-dropdown-item px-3 py-2 d-flex border-bottom" href="#"
                            style="border-color: var(--border-color)">
                            <div class="me-3 text-success">
                                <i class="bi bi-star-fill fs-5"></i>
                            </div>
                            <div>
                                <div class="fw-medium">New 5-star review</div>
                                <small class="text-muted">From John Smith</small>
                                <div class="text-muted small">1 hour ago</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="header-dropdown-item px-3 py-2 d-flex" href="#">
                            <div class="me-3 text-warning">
                                <i class="bi bi-exclamation-triangle fs-5"></i>
                            </div>
                            <div>
                                <div class="fw-medium">Inventory alert</div>
                                <small class="text-muted">5 products low in stock</small>
                                <div class="text-muted small">5 hours ago</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="header-dropdown-item text-center py-2 fw-medium d-block" href="#"
                            style="background-color: var(--bg-color)">
                            View all notifications
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Profile dropdown -->
            <div class="header-dropdown">
                <button class="btn btn-link p-0 d-flex align-items-center" onclick="toggleDropdown('profileDropdown')"
                    style="color: var(--text-color)">
                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" width="36" height="36"
                        alt="Profile" />
                    <div class="d-none d-lg-flex flex-column align-items-start me-1">
                        <span class="fw-medium">Admin User</span>
                        <small class="text-muted" style="font-size: 0.7rem">Administrator</small>
                    </div>
                    <i class="bi bi-chevron-down ms-1 small d-none d-lg-block"></i>
                </button>
                <ul class="header-dropdown-menu" id="profileDropdown" style="width: 220px">
                    <li>
                        <div class="header-dropdown-item px-3 py-3 d-flex align-items-center border-bottom"
                            style="border-color: var(--border-color)">
                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" width="40"
                                height="40" alt="Profile" />
                            <div>
                                <div class="fw-medium">Admin User</div>
                                <small class="text-muted">admin@example.com</small>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a class="header-dropdown-item px-3 py-2 d-flex align-items-center" href="#">
                            <i class="bi bi-person me-2"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a class="header-dropdown-item px-3 py-2 d-flex align-items-center" href="#">
                            <i class="bi bi-gear me-2"></i> Settings
                        </a>
                    </li>
                    <li>
                        <a class="header-dropdown-item px-3 py-2 d-flex align-items-center" href="#">
                            <i class="bi bi-envelope me-2"></i> Messages
                            <span class="badge bg-primary ms-auto">2</span>
                        </a>
                    </li>
                    <li class="border-top" style="border-color: var(--border-color)">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="btn header-dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg rounded-3 mb-4 p-3" style="background-color: var(--card-bg)">
    <div class="container-fluid">
        <button class="btn btn-light d-lg-none" id="mobileToggleBtn">
            <i class="bi bi-list"></i>
        </button>

        <div class="d-flex align-items-center ms-auto">
            <!-- Theme Toggle -->
            <button class="btn btn-light me-3" id="themeToggle">
                <i class="bi" id="themeIcon"></i>
            </button>

            <!-- Notifications with custom class -->
            <div class="header-dropdown me-3">
                <button class="btn btn-light position-relative"
                    onclick="toggleDropdown('notificationsDropdown')">
                    <i class="bi bi-bell"></i>
                    <span
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        3
                    </span>
                </button>
                <ul class="header-dropdown-menu" id="notificationsDropdown">
                    <li>
                        <h6 class="header-dropdown-item">Notifications</h6>
                    </li>
                    <li>
                        <a class="header-dropdown-item" href="#">New order received</a>
                    </li>
                    <li>
                        <a class="header-dropdown-item" href="#">Customer review</a>
                    </li>
                    <li>
                        <a class="header-dropdown-item" href="#">Inventory alert</a>
                    </li>
                </ul>
            </div>

            <!-- Profile Dropdown with custom class -->
            <div class="header-dropdown">
                <button class="btn btn-light dropdown-toggle d-flex align-items-center"
                    onclick="toggleDropdown('profileDropdown')">
                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2 profile-img"
                        alt="Profile" />
                    <span>Admin User</span>
                </button>
                <ul class="header-dropdown-menu" id="profileDropdown">
                    <li>
                        <a class="header-dropdown-item" href="#"><i class="bi bi-person me-2"></i>
                            Profile</a>
                    </li>
                    <li>
                        <a class="header-dropdown-item" href="#"><i class="bi bi-gear me-2"></i>
                            Settings</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="header-dropdown-item" href="#"><i
                                class="bi bi-box-arrow-right me-2"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
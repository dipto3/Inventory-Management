<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="admin/assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="admin/assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="admin/assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="admin/assets/images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

<<<<<<< HEAD
    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">Anna Adame</span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text"><i
                            class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span
                            class="align-middle">Online</span></span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <h6 class="dropdown-header">Welcome Anna!</h6>
            <a class="dropdown-item" href="pages-profile.html"><i
                    class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Profile</span></a>
            <a class="dropdown-item" href="apps-chat.html"><i
                    class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Messages</span></a>
            <a class="dropdown-item" href="apps-tasks-kanban.html"><i
                    class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Taskboard</span></a>
            <a class="dropdown-item" href="pages-faqs.html"><i
                    class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Help</span></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="pages-profile.html"><i
                    class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Balance :
                    <b>$5971.67</b></span></a>
            <a class="dropdown-item" href="pages-profile-settings.html"><span
                    class="badge bg-success-subtle text-success mt-1 float-end">New</span><i
                    class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Settings</span></a>
            <a class="dropdown-item" href="auth-lockscreen-basic.html"><i
                    class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lock
                    screen</span></a>
            <a class="dropdown-item" href="auth-logout-basic.html"><i
                    class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle"
                    data-key="t-logout">Logout</span></a>
=======
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Inventory</h6>
                    <ul>
                        <li><a href="{{ route('product.index') }}"><i data-feather="box"></i><span>Products</span></a>
                        </li>
                        {{-- <li><a href="add-product.html"><i
                                    data-feather="plus-square"></i><span>Create Product</span></a></li> --}}
                        <li><a href="{{ route('expired.products') }}"><i data-feather="codesandbox"></i><span>Expired
                                    Products</span></a></li>

                        <li class=""><a href="{{ route('category.index') }}"><i
                                    data-feather="codepen"></i><span>Category</span></a></li>
                        <li><a href="{{ route('subcategory.index') }}"><i data-feather="speaker"></i><span>Sub
                                    Category</span></a></li>
                        <li><a href="{{ route('brand.index') }}"><i data-feather="tag"></i><span>Brands</span></a></li>
                        <li><a href=""><i data-feather="tag"></i><span>Stores</span></a></li>
                        <li><a href="{{ route('unit.index') }}"><i data-feather="speaker"></i><span>Units</span></a>
                        </li>
                        <li><a href="{{ route('variant.index') }}"><i data-feather="layers"></i><span>Variant
                                    Attributes</span></a></li>
                                    <li><a href="{{ route('payment_type.index') }}"><i data-feather="layers"></i><span>Payment Types</span></a></li>
                        {{-- <li><a href="warranty.html"><i data-feather="bookmark"></i><span>Warranties</span></a></li>
                        <li><a href="barcode.html"><i data-feather="align-justify"></i><span>Print Barcode</span></a>
                        </li>
                        <li><a href="qrcode.html"><i data-feather="maximize"></i><span>Print QR Code</span></a></li> --}}
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Stock</h6>
                    <ul>
                        <li><a href=""><i data-feather="package"></i><span>Manage Stock</span></a></li>
                        <li><a href=""><i data-feather="clipboard"></i><span>Stock Adjustment</span></a></li>
                        <li><a href=""><i data-feather="truck"></i><span>Stock Transfer</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Sales</h6>
                    <ul>
                        <li><a href="sales-list.html"><i data-feather="shopping-cart"></i><span>Sales</span></a></li>
                        <li><a href="invoice-report.html"><i data-feather="file-text"></i><span>Invoices</span></a></li>
                        <li><a href="sales-returns.html"><i data-feather="copy"></i><span>Sales Return</span></a></li>
                        <li><a href="quotation-list.html"><i data-feather="save"></i><span>Quotation</span></a></li>
                        <li><a href="pos.html"><i data-feather="hard-drive"></i><span>POS</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Promo</h6>
                    <ul>
                        <li><a href="coupons.html"><i data-feather="shopping-cart"></i><span>Coupons</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Purchases</h6>
                    <ul>
                        <li><a href="purchase-list.html"><i data-feather="shopping-bag"></i><span>Purchases</span></a>
                        </li>
                        <li><a href="purchase-order-report.html"><i data-feather="file-minus"></i><span>Purchase
                                    Order</span></a></li>
                        <li><a href="purchase-returns.html"><i data-feather="refresh-cw"></i><span>Purchase
                                    Return</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Finance & Accounts</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="file-text"></i><span>Expenses</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="">Expenses</a>
                                </li>
                                <li><a href="">Expense
                                        Category</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Peoples</h6>
                    <ul>
                        <li><a href=""><i data-feather="user"></i><span>Customers</span></a></li>
                        <li><a href=""><i data-feather="users"></i><span>Suppliers</span></a></li>
                        <li><a href=""><i data-feather="home"></i><span>Stores</span></a></li>
                        <li><a href=""><i data-feather="archive"></i><span>Warehouses</span></a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="submenu-open">
                    <h6 class="submenu-hdr">HRM</h6>
                    <ul>
                        <li><a
                                href="https://dreamspos.dreamstechnologies.com/html/template/employees-grid.html"><i
                                    data-feather="user"></i><span>Employees</span></a></li>
                        <li><a
                                href="https://dreamspos.dreamstechnologies.com/html/template/department-grid.html"><i
                                    data-feather="users"></i><span>Departments</span></a></li>
                        <li><a href="https://dreamspos.dreamstechnologies.com/html/template/designation.html"><i
                                    data-feather="git-merge"></i><span>Designation</span></a></li>
                        <li><a href="https://dreamspos.dreamstechnologies.com/html/template/shift.html"><i
                                    data-feather="shuffle"></i><span>Shifts</span></a></li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i
                                    data-feather="book-open"></i><span>Attendence</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a
                                        href="https://dreamspos.dreamstechnologies.com/html/template/attendance-employee.html">Employee</a>
                                </li>
                                <li><a
                                        href="https://dreamspos.dreamstechnologies.com/html/template/attendance-admin.html">Admin</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i
                                    data-feather="calendar"></i><span>Leaves</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a
                                        href="https://dreamspos.dreamstechnologies.com/html/template/leaves-admin.html">Admin
                                        Leaves</a></li>
                                <li><a
                                        href="https://dreamspos.dreamstechnologies.com/html/template/leaves-employee.html">Employee
                                        Leaves</a></li>
                                <li><a
                                        href="https://dreamspos.dreamstechnologies.com/html/template/leave-types.html">Leave
                                        Types</a></li>
                            </ul>
                        </li>
                        <li><a href="https://dreamspos.dreamstechnologies.com/html/template/holidays.html"><i
                                    data-feather="credit-card"></i><span>Holidays</span></a>
                        </li>
                        <li class="submenu">
                            <a href="https://dreamspos.dreamstechnologies.com/html/template/payroll-list.html"><i
                                    data-feather="dollar-sign"></i><span>Payroll</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a
                                        href="https://dreamspos.dreamstechnologies.com/html/template/payroll-list.html">Employee
                                        Salary</a></li>
                                <li><a
                                        href="https://dreamspos.dreamstechnologies.com/html/template/payslip.html">Payslip</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Reports</h6>
                    <ul>
                        <li><a href=""><i data-feather="bar-chart-2"></i><span>Sales Report</span></a></li>
                        <li><a href=""><i data-feather="pie-chart"></i><span>Purchase report</span></a></li>
                        <li><a href=""><i data-feather="inbox"></i><span>Inventory Report</span></a></li>
                        <li><a href=""><i data-feather="file"></i><span>Invoice Report</span></a></li>
                        <li><a href=""><i data-feather="user-check"></i><span>Supplier Report</span></a></li>
                        <li><a href=""><i data-feather="user"></i><span>Customer Report</span></a></li>
                        <li><a href=""><i data-feather="file"></i><span>Expense Report</span></a></li>
                        <li><a href=""><i data-feather="bar-chart"></i><span>Income Report</span></a></li>
                        <li><a href=""><i data-feather="database"></i><span>Tax Report</span></a></li>
                        <li><a href=""><i data-feather="pie-chart"></i><span>Profit & Loss</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">User Management</h6>
                    <ul>
                        <li><a href=""><i data-feather="user-check"></i><span>Users</span></a></li>
                        <li><a href=""><i data-feather="shield"></i><span>Roles & Permissions</span></a></li>
                        <li><a href=""><i data-feather="lock"></i><span>Delete Account Request</span></a></li>
                    </ul>
                </li>

                <li class="submenu-open">
                    <h6 class="submenu-hdr">Settings</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="settings"></i><span>General
                                    Settings</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="">Profile</a>
                                </li>
                                <li><a href="">Security</a>
                                </li>
                                <li><a href="">Notifications</a>
                                </li>
                                <li><a href="">Connected
                                        Apps</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="globe"></i><span>Website
                                    Settings</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="">System
                                        Settings</a></li>
                                <li><a href="">Company
                                        Settings </a></li>
                                <li><a href="">Localization</a>
                                </li>
                                <li><a href="">Prefixes</a>
                                </li>
                                <li><a href="">Preference</a>
                                </li>
                                <li><a href="">Appearance</a>
                                </li>
                                <li><a href="">Social
                                        Authentication</a></li>
                                <li><a href="">Language</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="smartphone"></i>
                                <span>App Settings</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="">Invoice</a>
                                </li>
                                <li><a href="">Printer</a>
                                </li>
                                <li><a href="">POS</a>
                                </li>
                                <li><a href="">Custom
                                        Fields</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="monitor"></i>
                                <span>System Settings</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="">Email</a>
                                </li>
                                <li><a
                                        href=">SMS
                                        Gateways</a></li>
                                <li><a
                                        href="">OTP</a>
                                </li>
                                <li><a href="">GDPR
                                        Cookies</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="dollar-sign"></i>
                                <span>Settings</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="">Payment
                                        Gateway</a></li>
                                <li><a href="">Bank
                                        Accounts</a></li>
                                <li><a href="">Tax
                                        Rates</a></li>
                                <li><a href="">Currencies</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="hexagon"></i>
                                <span>Other Settings</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="">Storage</a>
                                </li>
                                <li><a href="">Ban
                                        IP Address</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href=""><i data-feather="log-out"></i><span>Logout</span> </a>
                        </li>
                    </ul>
                </li>

            </ul>
>>>>>>> c9969c0ab27468f4d98085fed9387604c2dfcd81
        </div>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Inventory</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('supplier.index') }}" class="nav-link">Supplier </a>
                            </li>
                            <li class="nav-item">

                                <a href="{{ route('product.index') }}" class="nav-link" data-key="t-analytics">
                                    Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('expired.products') }}" class="nav-link" data-key="t-crm">Expired
                                    Products </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('category.index') }}" class="nav-link">
                                    Category </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('subcategory.index') }}" class="nav-link">Sub Category </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('brand.index') }}" class="nav-link">Brands</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('unit.index') }}" class="nav-link">Units</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('variant.index') }}" class="nav-link">Variant Attributes</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Stock</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Manage Stock</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#sidebarSignIn" class="nav-link" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarSignIn" data-key="t-signin"> Sign In
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarSignIn">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-signin-basic.html" class="nav-link" data-key="t-basic">
                                                Basic
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-signin-cover.html" class="nav-link" data-key="t-cover">
                                                Cover
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarErrors" class="nav-link" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarErrors" data-key="t-errors"> Errors
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarErrors">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-404-basic.html" class="nav-link" data-key="t-404-basic">
                                                404
                                                Basic </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-404-cover.html" class="nav-link" data-key="t-404-cover">
                                                404
                                                Cover </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-404-alt.html" class="nav-link" data-key="t-404-alt"> 404
                                                Alt
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-500.html" class="nav-link" data-key="t-500"> 500 </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-offline.html" class="nav-link" data-key="t-offline-page">
                                                Offline Page </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>

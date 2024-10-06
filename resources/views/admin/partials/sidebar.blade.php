<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Main</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="subdrop active"><i
                                    data-feather="grid"></i><span>Dashboard</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('dashboard') }}" class="active">Admin Dashboard</a></li>
                                <li><a href="#">Sales
                                        Dashboard</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Inventory</h6>
                    <ul>
                        <li><a href="{{ route('product.index') }}"><i data-feather="box"></i><span>Products</span></a>
                        </li>
                        {{-- <li><a href="add-product.html"><i
                                    data-feather="plus-square"></i><span>Create Product</span></a></li> --}}
                        <li><a href=""><i data-feather="codesandbox"></i><span>Expired Products</span></a></li>
                       
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
                        <li><a href="warranty.html"><i data-feather="bookmark"></i><span>Warranties</span></a></li>
                        <li><a href="barcode.html"><i data-feather="align-justify"></i><span>Print Barcode</span></a>
                        </li>
                        <li><a href="qrcode.html"><i data-feather="maximize"></i><span>Print QR Code</span></a></li>
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
        </div>
    </div>
</div>

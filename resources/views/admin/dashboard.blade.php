 @extends('admin.layouts.master')
 @section('admin.content')
 <!-- Stats Cards -->
 <div class="row">
    <h3>Good Morning, Anna!</h3>
    <p>Here's what's happening with your store today.</p>
</div>
<div class="row mb-4">
    <div class="col-md-3 mb-4 mb-md-0">
        <div class="stat-card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">Total Revenue</h6>
                    <h3 class="mb-0">$24,580</h3>
                    <span class="text-success small"><i class="bi bi-arrow-up"></i> 12%</span>
                </div>
                <div class="bg-primary-light p-3 rounded">
                    <i class="bi bi-currency-dollar text-primary fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4 mb-md-0">
        <div class="stat-card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">Total Orders</h6>
                    <h3 class="mb-0">1,245</h3>
                    <span class="text-success small"><i class="bi bi-arrow-up"></i> 8%</span>
                </div>
                <div class="bg-success-light p-3 rounded">
                    <i class="bi bi-cart-check text-success fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4 mb-md-0">
        <div class="stat-card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">Customers</h6>
                    <h3 class="mb-0">856</h3>
                    <span class="text-success small"><i class="bi bi-arrow-up"></i> 5%</span>
                </div>
                <div class="bg-warning-light p-3 rounded">
                    <i class="bi bi-people text-warning fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">Pending Orders</h6>
                    <h3 class="mb-0">32</h3>
                    <span class="text-danger small"><i class="bi bi-arrow-down"></i> 2%</span>
                </div>
                <div class="bg-danger-light p-3 rounded">
                    <i class="bi bi-hourglass-split text-danger fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mb-4">
    <div class="col-md-8 mb-4 mb-md-0">
        <div class="stat-card p-4 h-100">
            <h5 class="mb-4">Sales Overview</h5>
            <div class="chart-container">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card p-4 h-100">
            <h5 class="mb-4">Revenue Sources</h5>
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="stat-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Recent Orders</h5>
        <a href="#" class="btn btn-sm btn-primary">View All</a>
    </div>
    <div class="table-responsive">
        <table class="table">
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
                    <td>#EC-1254</td>
                    <td>John Smith</td>
                    <td>2023-05-15</td>
                    <td>$245.00</td>
                    <td><span class="badge bg-success">Completed</span></td>
                    <td>
                        <button class="btn btn-sm btn-light">
                            <i class="bi bi-eye"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>#EC-1253</td>
                    <td>Sarah Johnson</td>
                    <td>2023-05-14</td>
                    <td>$189.50</td>
                    <td><span class="badge bg-warning">Processing</span></td>
                    <td>
                        <button class="btn btn-sm btn-light">
                            <i class="bi bi-eye"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>#EC-1252</td>
                    <td>Michael Brown</td>
                    <td>2023-05-14</td>
                    <td>$420.75</td>
                    <td><span class="badge bg-primary">Shipped</span></td>
                    <td>
                        <button class="btn btn-sm btn-light">
                            <i class="bi bi-eye"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

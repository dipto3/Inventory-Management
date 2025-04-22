@extends('admin.layouts.master')
@section('admin.content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Coupon Details</h5>
            <div>
                <a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <a href="{{ route('coupon.index') }}" class="btn btn-sm btn-secondary">Back to List</a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label text-muted">Coupon Code</label>
                        <div class="form-control bg-light bg-dark-mode-dark">
                            <strong class="text-dark text-dark-mode-light">{{ $coupon->code }}</strong>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Discount Type</label>
                        <div class="form-control bg-light bg-dark-mode-dark">
                            <span class="text-capitalize text-dark text-dark-mode-light">{{ $coupon->discount_type }}</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Discount Value</label>
                        <div class="form-control bg-light bg-dark-mode-dark">
                            <span class="text-dark text-dark-mode-light">
                                {{ $coupon->discount_value }}
                                @if($coupon->discount_type == 'percentage') % @else {{ config('settings.currency_symbol') }} @endif
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Minimum Order Amount</label>
                        <div class="form-control bg-light bg-dark-mode-dark">
                            <span class="text-dark text-dark-mode-light">{{ config('settings.currency_symbol') }}{{ $coupon->minimum_order_amount }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label text-muted">Maximum Discount</label>
                        <div class="form-control bg-light bg-dark-mode-dark">
                            <span class="text-dark text-dark-mode-light">
                                @if($coupon->maximum_discount_amount > 0)
                                    {{ config('settings.currency_symbol') }}{{ $coupon->maximum_discount_amount }}
                                @else
                                    No limit
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Validity Period</label>
                        <div class="form-control bg-light bg-dark-mode-dark">
                            <span class="text-dark text-dark-mode-light">
                                {{ \Carbon\Carbon::parse($coupon->start_date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($coupon->start_time)->format('h:i A') }} 
                                to 
                                {{ \Carbon\Carbon::parse($coupon->end_date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($coupon->end_time)->format('h:i A') }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Usage Limit</label>
                        <div class="form-control bg-light bg-dark-mode-dark">
                            <span class="text-dark text-dark-mode-light">
                                @if($coupon->usage_limit > 0)
                                    {{ $coupon->usage_limit }} times
                                @else
                                    Unlimited
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Status</label>
                        <div class="form-control bg-light bg-dark-mode-dark">
                            <span class="badge bg-{{ $coupon->status ? 'success' : 'danger' }}">
                                {{ $coupon->status ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information Section -->
            {{-- <div class="mt-4">
                <h6 class="text-muted mb-3">Usage Statistics</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm bg-light bg-dark-mode-dark">
                            <div class="card-body text-center">
                                <h3 class="text-dark text-dark-mode-light">125</h3>
                                <p class="text-muted mb-0">Total Used</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm bg-light bg-dark-mode-dark">
                            <div class="card-body text-center">
                                <h3 class="text-dark text-dark-mode-light">₹12,540</h3>
                                <p class="text-muted mb-0">Total Savings</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm bg-light bg-dark-mode-dark">
                            <div class="card-body text-center">
                                <h3 class="text-dark text-dark-mode-light">75</h3>
                                <p class="text-muted mb-0">Active Users</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
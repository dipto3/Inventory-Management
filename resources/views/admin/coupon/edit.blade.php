<div class="modal fade" id="editcouponModal" tabindex="-1" aria-labelledby="editcouponModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editcouponModalLabel">Edit Coupon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="updatecouponForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="coupon_id" id="edit_coupon_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label">Coupon Code</label>
                            <input type="text" class="form-control" placeholder="Enter coupon Title" name="code"
                                id="edit_code" required />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="discount_type" class="form-label">Discount type</label>
                            <select class="form-select" id="edit_discount_type" name="discount_type">
                                <option value="percentage">Percentage</option>
                                <option value="amount">Amount</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="discount_value" class="form-label">Discount value</label>
                            <input type="text" class="form-control" placeholder="Enter coupon Title"
                                name="discount_value" id="edit_discount_value" required />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="minimum_order_amount" class="form-label">Minimum order amount</label>
                            <input type="number" class="form-control" placeholder="Enter coupon minimum_order_amount"
                                name="minimum_order_amount" id="edit_minimum_order_amount" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="discount_value" class="form-label">Maximum discount amount</label>
                            <input type="text" class="form-control" placeholder="Enter maximum_discount_amount"
                                name="maximum_discount_amount" id="edit_maximum_discount_amount" required />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Start date</label>
                            <input type="date" class="form-control" placeholder="Enter start_date" name="start_date"
                                id="edit_start_date" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">End date</label>
                            <input type="text" class="form-control" placeholder="Enter end_date" name="end_date"
                                id="edit_end_date" required />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="start_time" class="form-label">Start Time</label>
                            <input type="time" class="form-control" placeholder="Enter start_time" name="start_time"
                                id="edit_start_time" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="end_time" class="form-label">End Time</label>
                            <input type="time" class="form-control" placeholder="Enter end_time" name="end_time"
                                id="edit_end_time" required />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="start_time" class="form-label">Usage Limit</label>
                            <input type="number" class="form-control" placeholder="Enter usage_limit"
                                name="usage_limit" id="edit_usage_limit" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="edit_status" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary update_banner">
                            Save Coupon
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="makePaymentModal{{ $purchase->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="">Make Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form method="POST" action="{{ route('purchase.payment.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row" style="padding: 10px;">
                    <div class="col-md-4">
                        <div class="card" style="background-color: rgb(0, 136, 247);color: white;">
                            <div class="card-body">
                                <h6 class="card-title" style="color: white;">Total Amount</h6>
                                <p class="card-text">{{ $purchase->grand_total }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="background-color: rgb(54, 151, 91);color: white;">
                            <div class="card-body">
                                <h6 class="card-title" style="color: white;">Paid Amount</h6>
                                <p class="card-text">{{ $purchase->purchasePayments->sum('amount') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="background-color: rgb(134, 60, 60);color: white;">
                            <div class="card-body">
                                <h6 class="card-title" style="color: white;">Due Amount</h6>
                                <p class="card-text">
                                    {{ max(0, $purchase->grand_total - $purchase->purchasePayments->sum('amount')) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="purchase_id" id="purchase_id" value="{{ $purchase->id }}"
                    class="form-control">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Amount</label>
                        <input type="number" class="form-control" name="amount" value="" required>
                    </div>
                    <div class="mb-3">
                        <label>Payment Method</label>
                        <select class="form-control" name="payment_method" required>
                            <option>Choose</option>
                            <option value="Bank">
                                Bank</option>
                            <option value="Cash">
                                Cash</option>
                            <option value="Mobile-Banking">
                                Mobile-Banking</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Account Number(from)</label>
                        <input type="number" class="form-control" name="account_number_from" value="" required>
                    </div>
                    <div class="mb-3">
                        <label>Account Number(to)</label>
                        <input type="number" class="form-control" name="account_number_to" value="" required>
                    </div>
                    <div class="mb-3">
                        <label>Payment Date</label>
                        <input type="date" class="form-control" name="payment_date" value="{{ date('Y-m-d') }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea type="text" id="image" name="note" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Document File</label>
                        <input type="file" id="file" name="file" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

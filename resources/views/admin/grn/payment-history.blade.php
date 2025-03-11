<div class="modal fade" id="paymentHistoryModal{{ $purchase->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title">Payment History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @forelse ($purchase->purchasePayments as $payment)
                        <div class="col-md-4">
                            <div class="border p-3 rounded shadow-sm">
                                <p><strong>Method:</strong> {{ $payment->payment_method }}</p>
                                <p><strong>Amount:</strong> {{ $payment->amount }}</p>
                                <p><strong>Account Number(from):</strong> {{ $payment->account_number_from }}</p>
                                <p><strong>Account Number(to):</strong> {{ $payment->account_number_to }}</p>
                                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($payment->date)->format('d F, Y') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <div class="alert alert-info">No payment history available.</div>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

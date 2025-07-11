@extends('user.layout.app')
@section('main-section')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Invoice</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Apps</a>
                            </li>
                            <li class="breadcrumb-item active">Invoice create</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form id="editInvoiceForm" method="POST"
                        action="{{ route('user.invoice.update', Crypt::encrypt($invoice->id)) }}">
                        @csrf
                        <div class="shadow border">
                            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Edit Invoice</h5>
                                <button type="button" id="addRow" class="btn btn-light btn-sm">
                                    <i class="fas fa-plus me-1"></i>Add Item
                                </button>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <div class="row p-3 m-0">
                                        <div class="col-md-6">
                                            <h6 class="fw-bold">Billed To</h6>
                                            <div class="mb-2">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="billed_name" class="form-control"
                                                    value="{{ $invoice->billed_name }}">
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">Address</label>
                                                <textarea name="billed_address" class="form-control" rows="2">{{ $invoice->billed_address }}</textarea>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">Phone</label>
                                                <input type="text" name="billed_phone" class="form-control"
                                                    value="{{ $invoice->billed_phone }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="fw-bold">Shipped To</h6>
                                            <div class="mb-2">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="shipped_name" class="form-control"
                                                    value="{{ $invoice->shipped_name }}">
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">Address</label>
                                                <textarea name="shipped_address" class="form-control" rows="2">{{ $invoice->shipped_address }}</textarea>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">Phone</label>
                                                <input type="text" name="shipped_phone" class="form-control"
                                                    value="{{ $invoice->shipped_phone }}">
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table table-hover align-middle table-bordered m-0" id="invoiceTable">
                                        <thead class="table-light text-center">
                                            <tr>
                                                <th>Product</th>
                                                <th>HSN Code</th>
                                                <th>Design</th>
                                                <th>Quantity</th>
                                                <th>Rate</th>
                                                <th>Amount</th>
                                                <th>Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody id="invoiceBody">
                                            @foreach ($invoice->items as $index => $item)
                                                <tr>
                                                    <td><input type="text" name="items[{{ $index }}][product]"
                                                            class="form-control" value="{{ $item->product }}"></td>
                                                    <td><input type="text" name="items[{{ $index }}][hsn]"
                                                            class="form-control" value="{{ $item->hsn }}"></td>
                                                    <td><input type="text" name="items[{{ $index }}][design]"
                                                            class="form-control" value="{{ $item->design }}"></td>
                                                    <td><input type="number" name="items[{{ $index }}][quantity]"
                                                            class="form-control calc text-end"
                                                            value="{{ $item->quantity }}"></td>
                                                    <td><input type="number" name="items[{{ $index }}][rate]"
                                                            class="form-control calc text-end" value="{{ $item->rate }}">
                                                    </td>
                                                    <td><input type="text" name="items[{{ $index }}][amount]"
                                                            class="form-control subtotal text-end bg-light"
                                                            value="{{ $item->amount }}" readonly></td>
                                                    <td class="text-center">
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger remove-row">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer bg-light">
                                <div class="row g-3">
                                    <div class="col-md-4 offset-md-5 text-end">
                                        <label class="form-label fw-semibold">Subtotal:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="subtotal" name="subtotal"
                                            class="form-control text-end bg-white" value="{{ $invoice->subtotal }}"
                                            readonly>
                                    </div>
                                    <div class="col-md-4 offset-md-5 text-end">
                                        <label class="form-label fw-semibold">Tax %:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" id="tax" name="tax"
                                            class="form-control text-end" value="{{ $invoice->tax }}">
                                    </div>
                                    <div class="col-md-4 offset-md-5 text-end">
                                        <label class="form-label fw-semibold">Total:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="total" name="total"
                                            class="form-control text-end bg-light" value="{{ $invoice->total }}"
                                            readonly>
                                    </div>
                                    <div class="col-md-12 text-end pt-3">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-save me-1"></i> Update Invoice
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/user/js/invoice/invoice-form.js') }}"></script>
@endsection

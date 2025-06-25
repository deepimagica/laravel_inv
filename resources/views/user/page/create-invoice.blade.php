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
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form id="invoiceForm" method="POST" action="{{ route('user.store.invoice') }}">
                    @csrf
                    <div class="card shadow border mb-4">
                        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Invoice Editor</h5>
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
                                            <label for="billed_name" class="form-label">Name</label>
                                            <input type="text" name="billed_name" id="billed_name" class="form-control"
                                                placeholder="Customer Name">
                                            <span class="text-danger pb-4" id="billed_name_error"></span>
                                        </div>
                                        <div class="mb-2">
                                            <label for="billed_address" class="form-label">Address</label>
                                            <textarea name="billed_address" id="billed_address" class="form-control" rows="2" placeholder="Full Address"></textarea>
                                            <span class="text-danger pb-4" id="billed_address_error"></span>
                                        </div>
                                        <div class="mb-2">
                                            <label for="billed_phone" class="form-label">Phone</label>
                                            <input type="text" name="billed_phone" id="billed_phone" class="form-control"
                                                placeholder="Phone Number">
                                            <span class="text-danger pb-4" id="billed_phone_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="fw-bold">Shipped To</h6>
                                        <div class="mb-2">
                                            <label for="shipped_name" class="form-label">Name</label>
                                            <input type="text" name="shipped_name" id="shipped_name" class="form-control"
                                                placeholder="Shipping Contact">
                                            <span class="text-danger pb-4" id="shipped_name_error"></span>
                                        </div>
                                        <div class="mb-2">
                                            <label for="shipped_address" class="form-label">Address</label>
                                            <textarea name="shipped_address" id="shipped_address" class="form-control" rows="2"
                                                placeholder="Shipping Address"></textarea>
                                            <span class="text-danger pb-4" id="shipped_address_error"></span>
                                        </div>
                                        <div class="mb-2">
                                            <label for="shipped_phone" class="form-label">Phone</label>
                                            <input type="text" name="shipped_phone" id="shipped_phone"
                                                class="form-control" placeholder="Phone Number">
                                            <span class="text-danger pb-4" id="shipped_phone_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-hover align-middle table-bordered m-0" id="invoiceTable">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th style="min-width: 140px">Product</th>
                                            <th>HSN Code</th>
                                            <th>Design</th>
                                            <th>Quantity</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th style="width: 50px">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody id="invoiceBody">
                                        <tr>
                                            <td>
                                                <input type="text" name="items[0][product]" class="form-control"
                                                    placeholder="Product Name">
                                                <span class="text-danger error-text" data-name="items.0.product"></span>
                                            </td>
                                            <td>
                                                <input type="text" name="items[0][hsn]" class="form-control"
                                                    placeholder="HSN Code">
                                                <span class="text-danger error-text" data-name="items.0.hsn"></span>
                                            </td>
                                            <td>
                                                <input type="text" name="items[0][design]" class="form-control"
                                                    placeholder="Design">
                                                <span class="text-danger error-text" data-name="items.0.design"></span>
                                            </td>
                                            <td>
                                                <input type="number" name="items[0][quantity]"
                                                    class="form-control calc text-end">
                                                <span class="text-danger error-text" data-name="items.0.quantity"></span>
                                            </td>
                                            <td>
                                                <input type="number" name="items[0][rate]"
                                                    class="form-control calc text-end">
                                                <span class="text-danger error-text" data-name="items.0.rate"></span>
                                            </td>
                                            <td>
                                                <input type="text" name="items[0][amount]"
                                                    class="form-control subtotal text-end bg-light"
                                                    readonly>
                                                <span class="text-danger error-text" data-name="items.0.amount"></span>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-row">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
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
                                        class="form-control text-end bg-white" readonly>
                                </div>

                                <div class="col-md-4 offset-md-5 text-end">
                                    <label class="form-label fw-semibold">Tax %:</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" id="tax" name="tax" class="form-control text-end"
                                        value="0">
                                </div>
                                <div class="col-md-4 offset-md-5 text-end">
                                    <label class="form-label fw-semibold">Total:</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" id="total" name="total"
                                        class="form-control text-end bg-light" readonly>
                                </div>
                                <div class="col-md-12 text-end pt-3">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save me-1"></i> Save Invoice
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

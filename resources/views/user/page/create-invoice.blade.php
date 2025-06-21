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
                <form id="invoiceForm" method="POST" action="">
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
                                <table class="table table-hover align-middle table-bordered m-0" id="invoiceTable">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th style="min-width: 140px">Item</th>
                                            <th>Description</th>
                                            <th>Hours</th>
                                            <th>Rate</th>
                                            <th>Subtotal</th>
                                            <th style="width: 50px">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody id="invoiceBody">
                                        <tr>
                                            <td><input type="text" name="items[0][title]" class="form-control"
                                                    placeholder="Item Title" required></td>
                                            <td><input type="text" name="items[0][description]" class="form-control"
                                                    placeholder="Short description"></td>
                                            <td><input type="number" name="items[0][hours]"
                                                    class="form-control calc text-end" value="0"></td>
                                            <td><input type="number" name="items[0][rate]"
                                                    class="form-control calc text-end" value="0"></td>
                                            <td><input type="text" name="items[0][subtotal]"
                                                    class="form-control subtotal text-end bg-light" value="0" readonly>
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
                                    <input type="text" id="subtotal" class="form-control text-end bg-white" readonly>
                                </div>

                                <div class="col-md-4 offset-md-5 text-end">
                                    <label class="form-label fw-semibold">Tax %:</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" id="tax" class="form-control text-end" value="0">
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
    <script>
        let rowIndex = 1;
        function calculateRow(row) {
            let hours = parseFloat(row.find('[name$="[hours]"]').val()) || 0;
            let rate = parseFloat(row.find('[name$="[rate]"]').val()) || 0;
            let subtotal = hours * rate;
            row.find('.subtotal').val(subtotal.toFixed(2));
        }

        function calculateTotal() {
            let total = 0;
            $('.subtotal').each(function() {
                total += parseFloat($(this).val()) || 0;
            });
            $('#subtotal').val(total.toFixed(2));

            let taxRate = parseFloat($('#tax').val()) || 0;
            let tax = total * (taxRate / 100);
            $('#total').val((total + tax).toFixed(2));
        }

        $(document).on('click', '#addRow', function() {
            let newRow = `
        <tr>
            <td><input type="text" name="items[${rowIndex}][title]" class="form-control" required></td>
            <td><input type="text" name="items[${rowIndex}][description]" class="form-control"></td>
            <td><input type="number" name="items[${rowIndex}][hours]" class="form-control calc text-end" value="0"></td>
            <td><input type="number" name="items[${rowIndex}][rate]" class="form-control calc text-end" value="0"></td>
            <td><input type="text" name="items[${rowIndex}][subtotal]" class="form-control subtotal text-end bg-light" value="0" readonly></td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="fas fa-trash"></i></button>
            </td>
        </tr>`;
            $('#invoiceBody').append(newRow);
            rowIndex++;
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
            calculateTotal();
        });

        $(document).on('input', '.calc, #tax', function() {
            $(this).closest('tr').each(function() {
                calculateRow($(this));
            });
            calculateTotal();
        });

        $(document).ready(function() {
            calculateRow($('#invoiceBody tr:first'));
            calculateTotal();
        });
    </script>
@endsection

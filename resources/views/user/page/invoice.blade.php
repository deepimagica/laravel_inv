@extends('user.layout.app')
@section('title', 'Invoice')
@section('main-section')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Invoice</h4>
                    <div>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Apps</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                </div>
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <div></div>
                    <div>
                        <a href="{{ route('user.create.invoice') }}"><button class="btn btn-primary">Create
                                Invoice</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info text-center fs-4 fw-bold" role="alert">
                    Here is Default Invoice design
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body bg-black rounded-top">
                        <div class="row">
                            <div class="col-4 align-self-center">
                                <img src="{{ asset('assets/user/images/logo-sm.png') }}" alt="logo-small" height="70">
                            </div>
                            <div class="col-8 text-end align-self-center">
                                <h5 class="mb-1 fw-semibold text-white"><span class="text-muted">Invoice:</span> #INV123456
                                </h5>
                                <h5 class="mb-0 fw-semibold text-white"><span class="text-muted">Issue Date:</span>
                                    {{ date('d/m/Y') }}</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Billing Details -->
                    <div class="card-body">
                        <div class="row row-cols-3 justify-content-between">
                            <div class="col-md-3">
                                <span class="badge rounded text-dark bg-light">Invoice to</span>
                                <h5 class="my-1 fw-semibold fs-18">Rajesh Textiles</h5>
                                <p class="text-muted">GSTIN: 24ABCDE1234F1Z5</p>
                            </div>
                            <div class="col-md-3">
                                <address class="fs-13">
                                    <strong>Billed To:</strong><br>
                                    123 Market Yard<br>
                                    Surat, Gujarat<br>
                                    P: +91-9876543210
                                </address>
                            </div>
                            <div class="col-md-3">
                                <address class="fs-13">
                                    <strong>Shipped To:</strong><br>
                                    78 Cotton Street<br>
                                    Mumbai, Maharashtra<br>
                                    P: +91-9876543210
                                </address>
                            </div>
                        </div>

                        <!-- Invoice Table -->
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Product</th>
                                                <th>HSN Code</th>
                                                <th>Design</th>
                                                <th>Quantity</th>
                                                <th>Rate</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Rayon Kurti</td>
                                                <td>6104</td>
                                                <td>Floral</td>
                                                <td>120 pcs</td>
                                                <td>₹250</td>
                                                <td>₹30,000</td>
                                            </tr>
                                            <tr>
                                                <td>Silk Saree</td>
                                                <td>5007</td>
                                                <td>Patola</td>
                                                <td>50 pcs</td>
                                                <td>₹750</td>
                                                <td>₹37,500</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-end"><strong>Sub Total</strong></td>
                                                <td>₹67,500</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-end"><strong>GST (5%)</strong></td>
                                                <td>₹3,375</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-end"><strong>Total</strong></td>
                                                <td><strong>₹70,875</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Signature -->
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <h5>Terms And Conditions:</h5>
                                <ul class="ps-3">
                                    <li><small>Payment to be made within 7 days.</small></li>
                                    <li><small>Goods once sold will not be taken back.</small></li>
                                    <li><small>Subject to Surat jurisdiction.</small></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 text-end">
                                <div style="width: 30%; float: right;">
                                    <small>Authorized Signature</small>
                                    <img src="{{ asset('assets/user/images/extra/signature.png') }}" alt=""
                                        class="mt-2 mb-1" height="24">
                                    <p class="border-top">Signature</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-12 col-xl-4 ms-auto align-self-center">
                                <div class="text-center"><small class="fs-12">Thank you very much for doing business with
                                        us.</small></div>
                            </div>
                            <div class="col-lg-12 col-xl-4">
                                <div class="float-end d-print-none mt-2 mt-md-0">
                                    <a href="javascript:window.print()" class="btn btn-info">Print</a>
                                    <a href="#" class="btn btn-primary">Submit</a>
                                    <a href="#" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('user.layout.app')
@section('title', 'Invoice')
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
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                </div>
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <span class="page-title"></span>
                    <div class="">
                        <a href="{{ route('user.create.invoice') }}"><button class="btn btn-primary">Create
                                Invoice</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body bg-black rounded-top">
                        <div class="row">
                            <div class="col-4 align-self-center">
                                <img src="{{ asset('assets/user/images/logo-sm.png') }}" alt="logo-small"
                                    class="logo-sm me-1" height="70">
                            </div>
                            <div class="col-8 text-end align-self-center">
                                <h5 class="mb-1 fw-semibold text-white"><span class="text-muted">Invoice:</span>
                                    #BBN2351D458</h5>
                                <h5 class="mb-0 fw-semibold text-white"><span class="text-muted">Issue Date:</span>
                                    20/07/2024</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row row-cols-3 d-flex justify-content-md-between">
                            <div class="col-md-3 d-print-flex align-self-center">
                                <div class="">
                                    <span class="badge rounded text-dark bg-light">Invoice to</span>
                                    <h5 class="my-1 fw-semibold fs-18">Michael Reyes</h5>
                                    <p class="text-muted ">@Michael_Reyes|+1 123 456 789</p>
                                </div>
                            </div>
                            <div class="col-md-3 d-print-flex align-self-center">
                                <div class="">
                                    <address class="fs-13">
                                        <strong class="fs-14">Billed To :</strong><br>
                                        854 Ave Folsom <br>
                                        San Francisco, CA 36925<br>
                                        <abbr title="Phone">P:</abbr> (123) 456-7890
                                    </address>
                                </div>
                            </div>
                            <div class="col-md-3 d-print-flex align-self-center">
                                <div class="">
                                    <address class="fs-13">
                                        <strong class="fs-14">Shipped To:</strong><br>
                                        795 Folsom Ave<br>
                                        San Francisco, CA 94107<br>
                                        <abbr title="Phone">P:</abbr> (123) 456-7890
                                    </address>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive project-invoice">
                                    <table class="table table-bordered mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Project Breakdown</th>
                                                <th>Hours</th>
                                                <th>Rate</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h5 class="mt-0 mb-1 fs-14">Project Design</h5>
                                                    <p class="mb-0 text-muted">It is a long established fact that a reader
                                                        will be distracted.</p>
                                                </td>
                                                <td>60</td>
                                                <td>$50</td>
                                                <td>$3000.00</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5 class="mt-0 mb-1 fs-14">Development</h5>
                                                    <p class="mb-0 text-muted">It is a long established fact that a reader
                                                        will be distracted.</p>
                                                </td>
                                                <td>100</td>
                                                <td>$50</td>
                                                <td>$5000.00</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5 class="mt-0 mb-1 fs-14">Testing & Bug Fixing</h5>
                                                    <p class="mb-0 text-muted">It is a long established fact that a reader
                                                        will be distracted.</p>
                                                </td>
                                                <td>10</td>
                                                <td>$20</td>
                                                <td>$200.00</td>
                                            </tr>

                                            <tr>
                                                <td colspan="1" class="border-0"></td>
                                                <td colspan="2" class="border-0 fs-14 text-dark"><b>Sub Total</b></td>
                                                <td class="border-0 fs-14 text-dark"><b>$82,000.00</b></td>
                                            </tr>
                                            <tr>
                                                <th colspan="1" class="border-0"></th>
                                                <td colspan="2" class="border-0 fs-14 text-dark"><b>Tax Rate</b></td>
                                                <td class="border-0 fs-14 text-dark"><b>$0.00%</b></td>
                                            </tr>
                                            <tr class="">
                                                <th colspan="1" class="border-0"></th>
                                                <td colspan="2" class="border-0 fs-14"><b>Total</b></td>
                                                <td class="border-0 fs-14"><b>$82,000.00</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="mt-4">Terms And Condition :</h5>
                                <ul class="ps-3">
                                    <li><small class="fs-12">All accounts are to be paid within 7 days from receipt of
                                            invoice. </small></li>
                                    <li><small class="fs-12">To be paid by cheque or credit card or direct payment
                                            online.</small></li>
                                    <li><small class="fs-12"> If account is not paid within 7 days the credits details
                                            supplied as confirmation of work undertaken will be charged the agreed quoted
                                            fee noted above.</small></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 align-self-center">
                                <div class="float-none float-md-end" style="width: 30%;">
                                    <small>Account Manager</small>
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

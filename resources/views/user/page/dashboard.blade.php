@extends('user.layout.app')
@section('main-section')
    <div class="container-fluid">
        <div class="container m-0 mt-3">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <a href="{{ route('user.invoice.list') }}" class="text-decoration-none">
                        <div class="card text-white bg-primary h-100">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div class="mr-3">
                                    <i class="fas fa-file-alt fa-3x"></i>
                                </div>
                                <div>
                                    <h5 class="card-title">Total Invoice</h5>
                                    <h3>{{ $invoicesCount }}</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layout.app')
@section('title', 'Plans List')
@section('css')
    <link href="{{ asset('assets/user/Libraries/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <style>
        table th,
        table td {
            border: 0.5px solid #eef0f3 !important;
        }
    </style>
@endsection
@section('main-section')
    {{-- <div class="container">
        <h2>Subscription Plans</h2>
        <a href="{{ route('admin.subscription-plans.create') }}" class="btn btn-success mb-3">Create New Plan</a>
        <table class="table table-bordered" id="plans-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Billing Period</th>
                    <th>Invoice Limit</th>
                    <th>Active</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div> --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Plans</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Apps</a>
                            </li>
                            <li class="breadcrumb-item active">Plans List</li>
                        </ol>
                        <a href="{{ route('admin.subscription-plans.create') }}" class="btn btn-success mt-3">Create New
                            Plan</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header-divider">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="plans-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Billing Period</th>
                                            <th>Invoice Limit</th>
                                            <th>Active</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/user/Libraries/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/user/Libraries/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(function() {
            $('#plans-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.subscription-plans.index') }}',
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'billing_period'
                    },
                    {
                        data: 'invoice_limit_per_month'
                    },
                    {
                        data: 'is_active'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });

        $(document).on('click', '.delete-btn', function() {
            let url = $(this).data('url');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                                $('#plans-table').DataTable().ajax.reload();
                            } else {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Delete request failed.', 'error');
                        }
                    });
                }
            });
        });
    </script>
@endsection

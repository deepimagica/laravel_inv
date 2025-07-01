@extends('admin.layout.app')
@section('title', 'Users List')
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Users</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Apps</a>
                            </li>
                            <li class="breadcrumb-item active">Users List</li>
                        </ol>
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
                                <table class="table table-bordered table-striped table-hover" id="invoiceTable">
                                    <thead>
                                        <tr>
                                            <th class="fw-bold">ID</th>
                                            <th class="fw-bold">User Name</th>
                                            <th class="fw-bold">Email</th>
                                            <th class="fw-bold">Created At</th>
                                            {{-- <th class="fw-bold">Action</th> --}}
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
        $(document).ready(function() {
            $('#invoiceTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.users') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false
                    // }
                ]
            });
        });
    </script>
@endsection

@extends('user.layout.app')
@section('title', 'User Profile')
@section('main-section')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">User Profile</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-6">
                <h4 class="page-title">Basic Info</h4>
                <div class="card">
                    <div class="card-body pt-3 pb-2">
                        <form>
                            <div class="my-3">
                                <label for="current_password" class="form-label">Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $user->name }}" disabled>
                                </div>
                            </div>
                            <div class="my-3">
                                <label for="current_password" class="form-label">Email</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ $user->email }}" disabled>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="page-title">Change Password</h4>
                <div class="card">
                    <div class="card-body pt-3 pb-2">
                        <form id="change-password-form">
                            @csrf
                            <div class="my-3">
                                <label for="current_password" class="form-label">Current Password <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="current_password"
                                        id="current_password">
                                    <span class="input-group-text" onclick="togglePassword('current_password', this)"
                                        style="cursor: pointer;">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>
                                </div>
                                <span class="text-danger pb-4" id="current_password_error"></span>
                            </div>

                            <div class="my-3">
                                <label for="new_password" class="form-label">New Password <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="new_password" name="new_password">
                                    <span class="input-group-text" onclick="togglePassword('new_password', this)"
                                        style="cursor: pointer;">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>
                                </div>
                                <span class="text-danger pb-4" id="new_password_error"></span>
                            </div>

                            <div class="my-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="new_password_confirmation"
                                        name="new_password_confirmation">
                                    <span class="input-group-text"
                                        onclick="togglePassword('new_password_confirmation', this)"
                                        style="cursor: pointer;">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>
                                </div>
                                <span class="text-danger pb-4" id="new_password_confirmation_error"></span>
                            </div>
                            <button class="btn btn-primary" type="submit">Change Password <i
                                    class="fas fa-sign-in-alt ms-2 my-2"></i></button>

                            <div id="password-change-message" class="mt-3"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#change-password-form').on('submit', function(e) {
                e.preventDefault();

                const form = $(this);
                const formData = form.serialize();
                const $submitBtn = form.find('button[type="submit"]');
                const originalBtnHtml = $submitBtn.html();

                $submitBtn.prop('disabled', true).html(
                    'Changing Password... <i class="fas fa-spinner fa-spin ms-2"></i>'
                );

                $('.text-danger').text('').hide();

                $.ajax({
                    url: '{{ route('user.changePassword') }}',
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $submitBtn.prop('disabled', false).html(originalBtnHtml);

                        if (response.success) {
                            Toast('success', response.message);
                            form[0].reset();
                        } else {
                            Toast('error', response.message);
                        }
                    },
                    error: function(xhr) {
                        $submitBtn.prop('disabled', false).html(originalBtnHtml);

                        const response = xhr.responseJSON;

                        if (xhr.status === 422 && response?.errors) {
                            $.each(response.errors, function(field, messages) {
                                const errorElement = $('#' + field + '_error');
                                if (errorElement.length) {
                                    errorElement.text(messages[0]).show();
                                    setTimeout(() => errorElement.fadeOut(), 3000);
                                }
                            });
                        } else if (xhr.status === 400 && response?.message ===
                            'Current password is incorrect.') {
                            $('#current_password_error').text(response.message).show();
                            setTimeout(() => $('#current_password_error').fadeOut(), 3000);
                        } else {
                            Toast('error', response?.message ||
                            'An unexpected error occurred.');
                        }
                    }
                });
            });
        });

        function togglePassword(fieldId, iconWrapper) {
            const input = document.getElementById(fieldId);
            const icon = iconWrapper.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection

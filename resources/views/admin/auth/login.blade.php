<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="dark" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="{{ asset('assets/user/images/favicon.ico') }}">
    <link href="{{ asset('assets/user/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/user/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/user/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/user/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/user/libs/animate.css/animate.min.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container-xxl">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 mx-auto">
                            <div class="card">
                                <div class="card-body p-0 bg-black auth-header-box rounded-top">
                                    <div class="text-center p-3">
                                        <a href="#" class="logo logo-admin">
                                            <img src="{{ asset('assets/user/images/logo-light.png') }}" height="50"
                                                alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 fw-semibold text-white fs-18">Let's Get Started Approx</h4>
                                        <p class="text-muted fw-medium mb-0">Sign in to continue to Approx.</p>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <form class="my-4" action="{{ route('admin.post.login.page') }}" method="POST"
                                        id="adminLoginForm">
                                        @csrf
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="email">Email<span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Enter email" value="{{ old('email') }}">
                                        </div>
                                        <span class="text-danger pb-4" id="email_error"></span>
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="password">Password<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Enter password">
                                        </div>
                                        <span class="text-danger pb-4 " id="password_error"></span>
                                        <div class="form-group row mt-3">
                                            <div class="col-sm-6">
                                            </div>
                                            <div class="col-sm-6 text-end">
                                                <a href="#" class="text-muted font-13"><i
                                                        class="dripicons-lock"></i> Forgot password?</a>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid mt-3">
                                                    <button class="btn btn-primary" type="submit">Log In <i
                                                            class="fas fa-sign-in-alt ms-1"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="text-center  mb-2">
                                        <p class="text-muted">Don't have an account ? <a href="#"
                                                class="text-primary ms-1">Signup</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/user/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/user/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/pages/sweet-alert.init.js') }}"></script>
    <script src="{{ asset('assets/user/js/app.js') }}"></script>
    <script src="{{ asset('assets/user/js/pages/custom-toast.js') }}"></script>
    <script>
        $('#adminLoginForm').on('submit', function(e) {
            e.preventDefault();

            let $form = $(this);
            let $btn = $form.find('button[type="submit"]');
            let originalBtnHtml = $btn.html();

            $btn.prop('disabled', true).html('Submitting... <i class="fas fa-spinner fa-spin ms-1"></i>');

            $form.find('span[id$="_error"]').hide().text('');

            $.ajax({
                type: 'POST',
                url: $form.attr('action'),
                data: $form.serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Toast('success', response.message);
                        setTimeout(() => {
                            window.location.href = response.data.redirect_url;
                        }, 1500);
                    } else {
                        $btn.prop('disabled', false).html(originalBtnHtml);
                    }
                },
                error: function(response) {
                    $btn.prop('disabled', false).html(originalBtnHtml);

                    if (response.status === 429) {
                        Toast('error', 'Too Many Requests', 'Please wait and try again.');
                    } else if (response.status === 401) {
                        Toast('warning', response.responseJSON?.message || 'Unauthorized');
                    } else if (response.responseJSON?.errors) {
                        let errors = response.responseJSON.errors;
                        $.each(errors, function(key, messages) {
                            $('#' + key + '_error').text(messages[0]).show();
                            setTimeout(() => $('#' + key + '_error').fadeOut(), 3000);
                        });
                    }
                }
            });
        });
    </script>

</body>

</html>

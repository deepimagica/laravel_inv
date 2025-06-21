<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="dark" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <title>User Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="{{ asset('assets/user/images/favicon.ico') }}">
    <link href="{{ asset('assets/user/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/user/libs/mobius1-selectr/selectr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/user/libs/huebee/huebee.min.css') }}" rel="stylesheet" type="text/css" />
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
                                        <a href="" class="logo logo-admin">
                                            <img src="{{ asset('assets/user/images/logo-light.png') }}" height="50"
                                                alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 fw-semibold text-white fs-18">Create an account</h4>
                                        <p class="text-muted fw-medium mb-0">Enter your detail to Create your account
                                            today.</p>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div id="custom-toast-container"
                                        style="position: fixed; top: 20px; right: 20px; z-index: 1050;"></div>
                                    <form class="my-4" action="{{ route('user.post.signup.page') }}" method="POST"
                                        id="userSignUpForm">
                                        @csrf
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="username">Name<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="username" name="name"
                                                placeholder="Enter name">
                                        </div>
                                        <span class="text-danger pb-4" id="name_error"></span>
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="email">Email<span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Enter email">
                                        </div>
                                        <span class="text-danger pb-4" id="email_error"></span>
                                        <div class="form-group mb-2">
                                            <label for="mobile_no" class="form-label">Mobile Number <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="country_code"
                                                    name="country_code" value="{{ $calling_code }}"
                                                    style="max-width: 80px; text-align: center;"
                                                    aria-label="Country code">
                                                <input type="text" class="form-control" id="mobile_no"
                                                    name="mobile_no" placeholder="Enter mobile no"
                                                    aria-describedby="country_code">
                                            </div>
                                        </div>
                                        <span class="text-danger pb-4 " id="country_code_error"></span>
                                        <span class="text-danger pb-4 " id="mobile_no_error"></span>
                                        <div class="form-group my-3 d-flex justify-content-center">
                                            <div class="cf-turnstile" name="captcha" id="captcha"
                                                data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}">
                                            </div>
                                        </div>
                                        <div class="text-danger my-3 text-center" id="captcha_error"
                                            style="display: none;"></div>
                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary" type="submit">Sign up <i
                                                            class="fas fa-sign-in-alt ms-1"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="text-center  mb-2">
                                        <p class="text-muted">Already have an account ? <a
                                                href="{{ route('login.page') }}" class="text-primary ms-2">Log
                                                in</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/user/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/user/libs/mobius1-selectr/selectr.min.js') }}"></script>
    <script src="{{ asset('assets/user/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/pages/sweet-alert.init.js') }}"></script>
    <script src="{{ asset('assets/user/js/app.js') }}"></script>
    <script src="{{ asset('assets/user/js/pages/custom-toast.js') }}"></script>
    <script src="{{ asset('assets/user/libs/huebee/huebee.pkgd.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/user/js/pages/forms-advanced.js') }}"></script>
    <script src="{{ asset('assets/user/libs/mobius1-selectr/selectr.min.js') }}"></script> --}}
    <script>
        window._cryptoKey = "{{ env('AEC_SECRET_KEY') }}";
    </script>
    <script src="{{ asset('assets/user/js/utils/crypto.js') }}"></script>
    {{-- <script>
        $('#userSignUpForm').on('submit', function(e) {
            e.preventDefault();
            let $btn = $(this).find('button[type="submit"]');
            let originalBtnHtml = $btn.html();
            $btn.prop('disabled', true).html('Submitting... <i class="fas fa-spinner fa-spin ms-1"></i>');

            let formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: formData,
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        Toast('success', 'Signup successful! Redirecting...');
                        setTimeout(function() {
                            window.location.href = response.data.redirect_url;
                        }, 3000);
                    } else {
                        console.log(response, "response");
                        $btn.prop('disabled', false).html(originalBtnHtml);
                    }
                },
                error: function(response) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    if (response.status === 429) {
                        Toast('error', 'Too Many Requests', 'Please wait and try again later.');
                        setTimeout(function() {
                            $("#login_error_message").fadeOut();
                        }, 3000);
                    } else if (response.responseJSON && response.responseJSON.errors) {
                        let errors = response.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $("#" + key + "_error").text(value[0]).show();
                            setTimeout(function() {
                                $("#" + key + "_error").fadeOut();
                            }, 3000);
                        });
                    }
                }
            });
        });
    </script> --}}

    <script>
        $('#userSignUpForm').on('submit', function(e) {
            e.preventDefault();
            let $btn = $(this).find('button[type="submit"]');
            let originalBtnHtml = $btn.html();
            $btn.prop('disabled', true).html('Submitting... <i class="fas fa-spinner fa-spin ms-1"></i>');

            let formData = serializeFormToObject($(this));
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: formData,
                dataType: "json",
                encrypt: true,
                success: function(response) {
                    if (response.success) {
                        Toast('success', response.message);
                        setTimeout(function() {
                            window.location.href = response.data.redirect_url;
                        }, 3000);
                    } else {
                        console.log(response, "response");
                        $btn.prop('disabled', false).html(originalBtnHtml);
                    }
                },
                error: function(response) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    if (response.status === 429) {
                        Toast('error', 'Too Many Requests', 'Please wait and try again later.');
                    } else if (response.status === 500) {
                        Toast('error', 'Something went wrong', 'Please wait and try again later.');
                    } else if (response.responseJSON) {
                        if (response.responseJSON.errors) {
                            let errors = response.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $("#" + key + "_error").text(value[0]).show();
                                setTimeout(function() {
                                    $("#" + key + "_error").fadeOut();
                                }, 3000);
                            });
                        }
                    }
                }
            });
        });

        // function serializeFormToObject(form) {
        //     return form.serializeArray().reduce((obj, item) => {
        //         obj[item.name] = item.value;
        //         return obj;
        //     }, {});
        // }


        function serializeFormToObject(form) {
            let formData = {};
            form.serializeArray().forEach(function(item) {
                if (formData[item.name]) {
                    if (!Array.isArray(formData[item.name])) {
                        formData[item.name] = [formData[item.name]];
                    }
                    formData[item.name].push(item.value);
                } else {
                    formData[item.name] = item.value;
                }
            });

            const token = document.querySelector('[name="cf-turnstile-response"]')?.value;
            if (token) {
                formData['cf-turnstile-response'] = token;
            }

            return formData;
        }
    </script>
</body>

</html>

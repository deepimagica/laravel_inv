@extends('admin.layout.app')
@section('main-section')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Plan</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Apps</a>
                            </li>
                            <li class="breadcrumb-item active">Plan create</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow border mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Update Subscription Plan</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.subscription-plans.update', $subscription_plan->id) }}" id="planForm"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Plan Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ old('name', $subscription_plan->name) }}"
                                        class="form-control">
                                    <span class="text-danger pb-4" id="name_error"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">Price (₹) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="price"
                                        value="{{ old('price', $subscription_plan->price) }}" step="0.01"
                                        class="form-control">
                                    <span class="text-danger pb-4" id="price_error"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="billing_period" class="form-label">Billing Period <span
                                            class="text-danger">*</span></label>
                                    <select name="billing_period" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="monthly"
                                            {{ old('billing_period', $subscription_plan->billing_period) == 'monthly' ? 'selected' : '' }}>
                                            Monthly</option>
                                        <option value="yearly"
                                            {{ old('billing_period', $subscription_plan->billing_period) == 'yearly' ? 'selected' : '' }}>
                                            Yearly</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="invoice_limit_per_month" class="form-label">Invoice Limit Per Month</label>
                                    <input type="number" name="invoice_limit_per_month"
                                        value="{{ old('invoice_limit_per_month', $subscription_plan->invoice_limit_per_month) }}"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Features</label>
                                <div id="features-wrapper">
                                    @foreach (old('features', $subscription_plan->features ?? []) as $feature)
                                        <input type="text" name="features[]" value="{{ $feature }}"
                                            class="form-control mb-1" />
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="addFeature()">+ Add
                                    Feature</button>
                                @error('features')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                    value="1" {{ old('is_active', $subscription_plan->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>

                            <button type="submit" class="btn btn-success">Edit Plan</button>
                            <a href="{{ route('admin.subscription-plans.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function addFeature() {
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'features[]';
            input.classList.add('form-control', 'mb-1');
            document.getElementById('features-wrapper').appendChild(input);
        }

        $('#planForm').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this);
            const submitBtn = formData.find('button[type="submit"]');
            const originalText = submitBtn.html();
            submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Saving...');
            $('span.text-danger').text('');

            $.ajax({
                url: formData.attr('action'),
                type: formData.attr('method'),
                data: formData.serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        Toast('success', response.message);
                        setTimeout(() => {
                            window.location.href = response.redirect_url;
                        }, 2000);
                    } else {
                        submitBtn.prop('disabled', false).html(originalText);
                    }
                },
                error: function(response) {
                    submitBtn.prop('disabled', false).html(originalText);
                    if (response.status === 422) {
                        $.each(response.responseJSON.errors, function(field, messages) {
                            $('#' + field + '_error').text(messages[0]);
                        });
                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                }
            })
        })
    </script>
@endsection

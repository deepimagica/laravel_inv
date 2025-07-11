let rowIndex = $('#invoiceBody tr').length;

function calculateRow(row) {
    const quantity = parseFloat(row.find('[name$="[quantity]"]').val()) || 0;
    const rate = parseFloat(row.find('[name$="[rate]"]').val()) || 0;
    const amount = quantity * rate;
    row.find('.subtotal').val(amount.toFixed(2));
}

function calculateTotal() {
    let total = 0;
    $('.subtotal').each(function () {
        total += parseFloat($(this).val()) || 0;
    });
    $('#subtotal').val(total.toFixed(2));

    const taxRate = parseFloat($('#tax').val()) || 0;
    const tax = total * (taxRate / 100);
    $('#total').val((total + tax).toFixed(2));
}

$(document).ready(function () {
    $('#invoiceBody tr').each(function () {
        calculateRow($(this));
    });
    calculateTotal();

    $('#addRow').on('click', function () {
        $.get('/user/invoice/item-row-template', { index: rowIndex }, function (html) {
            $('#invoiceBody').append(html);
            rowIndex++;
        });
    });

    $(document).on('click', '.remove-row', function () {
        $(this).closest('tr').remove();
        calculateTotal();
    });

    $(document).on('input', '.calc, #tax', function () {
        $(this).closest('tr').each(function () {
            calculateRow($(this));
        });
        calculateTotal();
    });

    const isEdit = $('#editInvoiceForm').length > 0;
    const formSelector = isEdit ? '#editInvoiceForm' : '#invoiceForm';
    $(formSelector).on('submit', function (e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = form.find('button[type=submit]');
        const originalBtnHtml = submitBtn.html();
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Saving...');

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function (response) {
                if (response.success) {
                    Toast('success', response.message);
                    form.trigger('reset');
                    $.get('/user/invoice/item-row-template', { index: 0 }, function (html) {
                        $('#invoiceBody').html(html);
                        rowIndex = 1;
                        $('#subtotal, #total').val('0.00');
                        $('#tax').val('0');
                    });
                    setTimeout(() => {
                        window.location.href = response.redirect_url;
                    }, 2000);
                } else {
                    submitBtn.prop('disabled', false).html(originalBtnHtml);
                }
            },
            error: function (response) {
                submitBtn.prop('disabled', false).html(originalBtnHtml);
                const errors = response.responseJSON?.errors || {};
                $('.error-text').text('');
                $.each(errors, function (key, value) {
                    const field = $('.error-text[data-name="' + key + '"]');
                    if (field.length) {
                        field.text(value[0]).show();
                        setTimeout(() => {
                            field.fadeOut();
                        }, 3000);
                    } else {
                        $("#" + key + "_error").text(value[0]).show();
                        setTimeout(() => {
                            $("#" + key + "_error").fadeOut();
                        }, 3000);
                    }
                });
                if (errors['items']) {
                    Toast('error', errors['items'][0]);
                    setTimeout(() => {
                        window.location.href = location.href;
                    }, 3000);
                    return;
                }
            },
            complete: function () {
                submitBtn.prop('disabled', false).html(originalBtnHtml);
            }
        });
    });
});

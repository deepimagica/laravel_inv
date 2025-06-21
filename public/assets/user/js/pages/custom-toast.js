// window.showCustomToast = function(message, title = 'Error', type = 'danger', duration = 3000) {
//     let container = $('#custom-toast-container');
//     if (container.length === 0) {
//         $('body').append('<div id="custom-toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 1050;"></div>');
//         container = $('#custom-toast-container');
//     }

//     const toastId = 'custom-toast-' + Date.now();

//     const toastHtml = `<div id="${toastId}" class="alert alert-${type} alert-dismissible fade show shadow-sm border-theme-white-2 mb-0 mt-2" role="alert">
//         <div class="d-inline-flex justify-content-center align-items-center thumb-xs bg-${type} rounded-circle mx-auto me-1">
//             <i class="fas fa-xmark align-self-center mb-0 text-white"></i>
//         </div>
//         <strong>${title}</strong> ${message}
//         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//     </div>`;

//     container.append(toastHtml);

//     // Auto-hide after duration
//     setTimeout(() => {
//         $('#' + toastId).fadeOut(400, function() {
//             $(this).remove();
//         });
//     }, duration);
// };


function Toast(icon = 'info', title = '', text = '') {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    if (text === '') {
        Toast.fire({
            icon: icon,
            title: title
        });
    } else {
        Toast.fire({
            icon: icon,
            title: title,
            text: text
        });
    }
}


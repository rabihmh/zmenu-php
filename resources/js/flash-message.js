document.addEventListener("DOMContentLoaded", function () {
    if (window.flashMessages.success) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: window.flashMessages.success,
            showCloseButton: true,
            timer: 5000
        });
    }

    if (window.flashMessages.error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: window.flashMessages.error,
            showCloseButton: true,
            timer: 5000
        });
    }

    if (window.flashMessages.warning) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: window.flashMessages.warning,
            showCloseButton: true,
            timer: 5000
        });
    }

    if (window.flashMessages.info) {

        Swal.fire({
            icon: 'info',
            title: 'Info',
            text: window.flashMessages.info,
            showCloseButton: true,
            timer: 5000
        });
    }

    if (window.flashMessages.status) {
        Swal.fire({
            icon: 'success',
            title: 'Status',
            text: window.flashMessages.status,
            showCloseButton: true,
            timer: 5000
        });
    }
});

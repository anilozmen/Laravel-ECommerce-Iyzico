$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    var status = parseInt($("body").data("status"));

    switch (status) {
        case 0 :
            toastr.error('Please fill every section in your profile!');
            break;
        case 1 :
            toastr.success('Successful');
            break;
        case 2:
            toastr.success('Your Order Has Been Successfully Completed');
            break;
    }
});
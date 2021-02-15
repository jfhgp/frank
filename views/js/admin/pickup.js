$(document).ready(function (){
    $('.form-ready-for-pickup').on('submit', function(event){
        event.preventDefault();
        $form = $(this);
        $.ajax({
            url: '../modules/frank/ajax/pickupAjax.php',
            method: 'POST',
            data: $form.serialize(),
            success: function (response) {

                response = JSON.parse(response);
                console.log(response);
                if (response.status === 200) {
                    $('#ready-for-pickup-btn').hide();
                    $('#cancel-order-btn').hide();
                }
            }
        });
    });

    $('.order-cancel').on('submit', function (event){
        event.preventDefault();
        $form = $(this);
        $.ajax({
            url: '../modules/frank/ajax/cancelOrderAjax.php',
            method: 'POST',
            data: $form.serialize(),
            success: function (response) {
                response = JSON.parse(response);
                console.log(response);
                if (response.status === 200) {
                    $('#ready-for-pickup-btn').hide();
                    $('#cancel-order-btn').hide();
                }
            }
        });
    });
});

// $(document).ready(function (){
//     $('.order-cancel').on('submit', function(event){
//         event.preventDefault();
//         $form = $(this);
//         console.log($form);
//         $.ajax({
//             url: '../modules/frank/orderCancelAjax.php',
//             method: 'POST',
//             data: $form.serialize(),
//             success: function (response) {
//                 response = JSON.parse(response);
//                 let alert = $('.status');
//                 alert.addClass('alert');
//                 alert.removeClass('alert-danger');
//                 alert.addClass('alert-success');
//                 alert.html(response.message);
//             }
//         });
//     });
// });
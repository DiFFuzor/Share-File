$(document).ready(function () {

    //Show sign in
    $(document).on('click', '.button_sign_in', function() {
        $('.welcome').fadeOut(1000, function () {
            $('#register_form').fadeOut(1000, function () {
                $('#login_form').fadeIn(1000);
            });
        });
    });

    //Show registration
    $(document).on('click', '.button_registration', function() {
        $('.welcome').fadeOut(1000, function () {
            $('#login_form').fadeOut(1000, function () {
                $('#register_form').fadeIn(1000);
            });
        });
    });


});
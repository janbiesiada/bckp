/*
|   Show Send Email Verfication Box
*/
$(".verifyemail").click(function(event) {
    event.preventDefault();
    $(".verifyconfirm").fadeIn('slow');
});

/*
|   Close Send Email Verification Box
*/
$(".verifyconfirm .close").click(function() {
    $(".verifyconfirm").fadeOut('slow');
});

/*
|   Email verification box - Resend email verification event
*/
$(".verifyconfirm .resendverification").click(function(event) {
    event.preventDefault();

    $.ajax({
        type: 'POST',
        url: '/account/verify',
        success: function(res) {
            if (res === true) {
                $(".verifyconfirm p").text("Verification link sent, check email for link!");

                setTimeout(function() {
                    $(".verifyconfirm").fadeOut('slow');
                }, 5000);
            }
        }
    });
});
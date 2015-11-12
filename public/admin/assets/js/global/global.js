'use strict';

/*  
|   Close Global Notification   
*/

var $global_close = $(".global .close"),
    $global_notification = $(".global");

$($global_close).on('click', hideGlobalNotification);

/*  
|   Hide Global Notification after 5 seconds of visibility  
*/
if ($('.global').length) {
    setTimeout(function() {
        $('.global').fadeOut('slow');
    }, 3000);
}

function hideGlobalNotification(event) {
    $($global_notification).fadeOut('slow');
}

var request_check = false;
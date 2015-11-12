'use strict';

var $global_notification = $(".global"),
    $global_close = $(".global .close");


/*  
|   Close Global Notification   
*/
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


/*
|   Sticky Sidebar, Stick on scroll
*/
$("#sticky_me").stick_in_parent({
    offset_top: 60,
    bottoming: false,
    recalc_every: 5
});/*.on("sticky_kit:stick", function(e) {
    $("#sticky_me").fadeIn('fast');
  })
  .on("sticky_kit:unstick", function(e) {
    $("#sticky_me").fadeOut('fast');
  });*/


$('.share').click(function(e) {
    e.preventDefault();
    window.open($(this).attr('href'), 'fbShareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
    return false;
});
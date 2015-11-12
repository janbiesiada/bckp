$(".popup .overlay").not(".popup .login-popup").on('click',hideLoginPopUpOverlay);
    
    
function hideLoginPopUpOverlay() {
	$(".popup").fadeOut(100, function() {
		$(".login-popup").removeClass('ahzp-done').addClass('ahzp-ready');
	});
}

$(".showloginbox").click(function(e) {
	/* Act on the event */
	e.preventDefault();
	
    hideRegisterOverlay();
    
	$("#login-popup").fadeIn(100, function() {
		$(".login-popup").removeClass('ahzp-ready').addClass('ahzp-done');
	});
});


$(".popup .overlay").not(".popup .register-popup").on('click',hideRegisterOverlay);
function hideRegisterOverlay() {
	/* Act on the event */
	$(".popup").fadeOut(100, function() {
		$(".register-popup").removeClass('ahzp-done').addClass('ahzp-ready');
	});
}

$(".showregisterbox").on('click', showRegisterOptions);
    
function showRegisterOptions(e) {
    
	e.preventDefault();
    
    hideLoginPopUpOverlay();
	$("#register-popup").fadeIn(100, function() {
		$(".register-popup").removeClass('ahzp-ready').addClass('ahzp-done');
	});
}



$(".popup .overlay").not(".popup .register-popup-form").on('click',hideRegisterFormOverlay);
function hideRegisterFormOverlay() {
	/* Act on the event */
	$(".popup").fadeOut(100, function() {
		$(".register-popup-form").removeClass('ahzp-done').addClass('ahzp-ready');
	});
}

$(".registeruser").click(function(e) {
	/* Act on the event */
	e.preventDefault();
    
    hideRegisterOverlay();
	$("#register-popup-form").fadeIn(100, function() {
		$(".register-popup-form").removeClass('ahzp-ready').addClass('ahzp-done');
	});
});












/*
if ($(".navbar-toggle").attr('aria-expanded') === "true") {
        $(".navbar-toggle").click();
    }
*/

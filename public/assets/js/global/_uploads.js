$(".popup .overlay").not(".popup .new-uploadpost").on('click',hideFileUploadForm);
    
    
function hideFileUploadForm() {
	$(".popup").fadeOut(100, function() {
		$(".new-uploadpost").removeClass('ahzp-done').addClass('ahzp-ready');
	});
}

$(".postupload").click(function(e) {
	/* Act on the event */
	e.preventDefault();
	$("#new-uploadpost").fadeIn(100, function() {
		$(".new-uploadpost").removeClass('ahzp-ready').addClass('ahzp-done');
	});
});


$(".popup .overlay").not(".popup .url-uploadpost").on('click',hidePostURLForm);
    
    
function hidePostURLForm() {
	$(".popup").fadeOut(100, function() {
		$(".url-uploadpost").removeClass('ahzp-done').addClass('ahzp-ready');
	});
}

$(".postfromurl").click(function(e) {
	/* Act on the event */
	e.preventDefault();
	$("#url-uploadpost").fadeIn(100, function() {
		$(".url-uploadpost").removeClass('ahzp-ready').addClass('ahzp-done');
	});
});



$(".popup .overlay").not(".popup .video-vine").on('click',hideVineVideoForm);
    
    
function hideVineVideoForm() {
	$(".popup").fadeOut(100, function() {
		$(".video-vine").removeClass('ahzp-done').addClass('ahzp-ready');
	});
}

$(".vineupload").click(function(e) {
    
	/* Act on the event */
	e.preventDefault();
	$("#video-vine").fadeIn(100, function() {
		$(".video-vine").removeClass('ahzp-ready').addClass('ahzp-done');
	});
});



$(".popup .overlay").not(".popup .video-youtube").on('click',hideYoutubeVideoForm);
    
    
function hideYoutubeVideoForm() {
	$(".popup").fadeOut(100, function() {
		$(".video-youtube").removeClass('ahzp-done').addClass('ahzp-ready');
	});
}

$(".youtubeupload").click(function(e) {
    
	/* Act on the event */
	e.preventDefault();
	$("#video-youtube").fadeIn(100, function() {
		$(".video-youtube").removeClass('ahzp-ready').addClass('ahzp-done');
	});
});









if ($('meta[name=uploadfailure]').attr("content")) {
    setTimeout(function() {
    $(".postupload").click();
    }, 1000);
}


if ($('meta[name=url-uploadfailure]').attr("content")) {
    setTimeout(function() {
    $(".postfromurl").click();
    }, 1000);
}

if ($('meta[name=vine-uploadfailure]').attr("content")) {
    setTimeout(function() {
    $(".vineupload").click();
    }, 1000);
}

if ($('meta[name=youtube-uploadfailure]').attr("content")) {
    setTimeout(function() {
    $(".youtubeupload").click();
    }, 1000);
}


if ($("#hashtags").val("")) {
    $("#hashtags").val("#");
}

$("#hashtags, #url-postHashTags").on('keyup', function(event) {

    if (event.which === 13) {
        event.preventDefault();
    } else {
        if (event.which != 65 && event.which != 17) {
            if (event.which != 8) {
                if (event.which === 32) {
                    var b = this.value.replace('#', '');
                    this.value = '#' + b;
                    if (this.value.indexOf(' ')) {
                        this.value = this.value.replace(' ', ',#');
                    }
                }
            }
        }
    }
});

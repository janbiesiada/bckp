$(".showlanguages").on('click', function(e){
    e.preventDefault();
    $(".language-menu").slideDown('fast');
    
    triggerHideLanguagesMenu();
});

$(".closelanguages").on('click', function(e) {
    e.preventDefault();
    $(".language-menu").slideUp('fast');
});

function triggerHideLanguagesMenu(){
    setTimeout(function(){
        $(".language-menu").slideUp('fast');
    },5000);
}

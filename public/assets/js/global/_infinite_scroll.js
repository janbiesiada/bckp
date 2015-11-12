$('.pages').hide();

$('.content-to-load').jscroll({
    debug: false,
    autoTrigger: true,
    loadingHtml: '<img src="https://9gag-waleedahmad.c9.io/assets/uploads/loading.gif" alt="Loading" style="width:20px; height: 20px;">',
    nextSelector: '.pages li:last a',
    contentSelector: '.content-to-load',
    callback: function() {

    $('.pages').hide();
        autoScrollRebinding();
    }
});

function autoScrollRebinding(){
    $(".downvote").unbind('click', downvote);
    $(".upvote").unbind('click', upvote);
    $(".downvote").on('click', downvote);
    $(".upvote").on('click', upvote);
    
    $(".upvotecomment").unbind('click', upvoteComment);
    $(".downvotecomment").unbind('click', downVoteComment);
    $(".upvotecomment").on('click', upvoteComment);
    $(".downvotecomment").on('click', downVoteComment);
    
    
    $(".showregisterbox").unbind('click', showRegisterOptions);
    $(".showregisterbox").on('click', showRegisterOptions);
    
    $(".remove-post").unbind('click',removeUserPosts);
    $(".remove-post").on('click',removeUserPosts);
    
    $(".unfollow-content").unbind('click',hideContent);
    $(".unfollow-content").on('click',hideContent);

    $(".follow-content").unbind('click',followContent);
    $(".follow-content").on('click',followContent);


}
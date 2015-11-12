/*
|   Reply Comments
*/

$(".reply-comment").on('click', generateCommentReplyForm);

function generateCommentReplyForm(event) {
    event.preventDefault();
    var $target = $(this),
        user = new Object(),
        id = $(this).attr('data-id');



    $.ajax({
        type: 'POST',
        url: '/get/details',
        success: function(res) {
            
            if (res.status) {
                
                $(".comment-reply").remove();
                
                user = res.user;

                var $reply_dom  =   '<li class="comment-reply">' 
                                        + '<div class="profilepic">' 
                                            + '<img src="'+ user.dp_uri +'" alt="lp" class="thumb">' 
                                        + '</div>'

                                        +'<div class="reply">' 
                                            + '<form class="reply-form">' 
                                                + '<div class="form-group">' 
                                                    + '<textarea class="form-control" data-id="' + id + '" id="post-reply" style="resize:none; height: 50px;" placeholder="Leave a reply!" rows="5" name="reply"></textarea>' 
                                                + '</div>'

                                                + '<div class="form-group actions">' 
                                                    + '<button type="submit" class="btn-submit submit-reply">Post</button>' 
                                                + '</div>' 
                                            + '</form>' 
                                        + '</div>' 
                                    + '</li>';
                
                
                $($target).parents('ul').children('li').eq(0).after($reply_dom);

                $("#post-reply").on('focus', showReplyForm);
                $("#post-reply").on('blur', hideReplyActions);
                $(".submit-reply").on('click', submitCommentReply);

                $("#post-reply").focus();
            }
        }
    });
}

/*
|   Post Comment Reply
*/

$(".submit-reply").on('click', submitCommentReply);

function submitCommentReply(event) {
    event.preventDefault();
    var $reply = $("#post-reply"),
        $c_id = $($reply).attr('data-id'),
        $target = $(this);


    if ($reply.val().length > 0) {
        
        $($target).attr('disabled', true);
        $.ajax({
            type: 'POST',
            url: '/post/reply',
            data: {
                reply: $reply.val(),
                c_id: $c_id
            },
            success: function(res) {
                
                if (res.status) {
                    var $reply_dom  =   '<li class="comment-replies">'
                                            + '<div class="profilepic">' 
                                                + '<img src="' + res.user.dp_uri + '" alt="lp" class="thumb">' 
                                            + '</div>'

                                            +'<div class="replies">' 
                                                + '<div class="blockquote">' 
                                                    + '<header class="meta">' 
                                                        + '<a target="_blank" href="/s/' + res.user.username + '">' + res.user.username + '</a>'
                                                        + '<div class="replyactions">'
                                                            + '<ul class="dropdown">'
                                                                + '<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="flicon flaticon-caret"></i> </a>'
                                                                + '<ul class="dropdown-menu dropdown-menu-right">'
                                                                    + '<a class="remove-reply" data-rid="'+res.reply_id+'" >Delete Comment</a>'
                                                                + '</ul>'
                                                            + '</ul>'
                                                        + '</div>'
                                                        
                                                    + '</header>'
                                                    
                                                    +'<div class="reply-body">'
                                                        +'<p class="reply">'+$reply.val()+'</p>'
                                                    +'</div>'
                                                    
                                                    + '<footer>' 
                                                        + '<div class="viewer-opinion">' 
                                                            + '<span href="#"><i data-username="'+res.user.username+'" data-id="' + res.reply_id + '" class="flicon flaticon-thumbs-up upvotereply up-vote"></i></span>' 
                                                            + '<span>0</span>' 
                                                            + '<span href="#"><i data-username="'+res.user.username+'" data-id="' + res.reply_id + '" class="flicon flaticon-thumbs-down downvotereply votedown"></i></span>' 
                                                        + '</div>' 
                                                    + '</footer>'

                                                + '</div>' 
                                            + '</div>' 
                                        + '</li>';

                    $($target).parents('ul').children('li').eq(0).after($reply_dom);
                    $(".comment-reply").remove();
                    reBindCommentRepliesEvents();
                }
                
                $($target).attr('disabled', false);
            }
        });
    }
}

function reBindCommentRepliesEvents(){
    $(".upvotereply").unbind('click', upvoteReply);
    $(".downvotereply ").unbind('click', downVoteReply);
    $(".upvotereply").on('click', upvoteReply);
    $(".downvotereply ").on('click', downVoteReply);
    
    $(".remove-reply").unbind('click', removePostReply);
    $(".remove-reply").on('click', removePostReply);

}


/*
|   Comment Replies Posting Handlers and logic
*/

$("#post-reply").on('focus', showReplyForm);

function showReplyForm(event) {
    var $target = $(this),
        $actions = $(this).parent().siblings(".actions");

    $($actions).slideDown('fast');
    $($target).attr('placeholder', 'Leave a reply');
}


$("#post-reply").on('blur', hideReplyActions);

function hideReplyActions(event) {
    var $target = $(this),
        $actions = $(this).parent().siblings(".actions");

    if ($target.val().length > 0) {

    } else {
        $($actions).slideUp('fast');
        $($target).attr('placeholder', 'Write a reply!');
    }
}
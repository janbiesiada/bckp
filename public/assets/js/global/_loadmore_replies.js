$(".load-more-replies").on('click', loadMoreReplies);

function loadMoreReplies(event) {
    event.preventDefault();

    var $target = $(this),
        c_id = $($target).attr('data-cid'),
        offset = $($target).attr('data-offset'),
        $replies = '',
        $opinion = '',
        count = 0;

    $.when($.ajax({
        type: 'POST',
        url: '/load/replies',
        async: true,
        data: {
            comment_id: c_id,
            d_offset: offset
        },
        success: function(res) {
            count = res.reply_count;
            if (res.status) {
                
                var $reply_actions      = '',
                    $reply_delete       = '',
                    $reply_report       = '',
                    reply_up_classes    = '',
                    reply_down_classes  = '',
                    $edit_reply         = '';
                
                for (var j = 0; j < res.replies.length; j++) {
                    
                    $reply_delete   =   (res.replies[j].owner) ? '<a class="remove-reply" data-cid="'+c_id+'" data-rid="'+res.replies[j].id+'" >Delete Comment</a>': '';
                    $edit_reply     =   (res.replies[j].owner) ? '<a class="edit-reply" data-cid="'+c_id+'" data-rid="'+res.replies[j].id+'" >Edit Comment</a>': '';
                    $reply_report   =   (res.session) ? (!res.replies[j].owner) ? '<a class="report-reply" data-cid="'+c_id+'" data-rid="'+res.replies[j].id+'" >Report Comment</a>' : '' : '<a class="showregisterbox" data-cid="'+c_id+'" data-rid="'+res.replies[j].id+'" >Report Comment</a>';
                    
                    $reply_actions   =  '<div class="replyactions">'
                                            +'<ul class="dropdown">'
                                                +'<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="flicon flaticon-caret"></i> </a>'
                                                +'<ul class="dropdown-menu dropdown-menu-right">'
                                                    +$reply_delete
                                                    +$reply_report
                                                    +$edit_reply
                                                +'</ul>'
                                            +'</ul>'
                                        +'</div>';
                    
                    
                    
                    reply_up_classes    = '',
                    reply_down_classes  = '';
                    
                    if (res.session) {
                        if (res.replies[j].up) {
                            reply_up_classes    = 'flicon flaticon-thumbs-up upvotereply checked unvote';
                            reply_down_classes  = 'flicon flaticon-thumbs-up downvotereply votedown';
                        
                        } 
                        else if (res.replies[j].down) {
                            reply_up_classes    = 'flicon flaticon-thumbs-up upvotereply up-vote';
                            reply_down_classes  = 'flicon flaticon-thumbs-up downvotereply checked unvotedown';
                        } 
                        else {
                            reply_up_classes    = 'flicon flaticon-thumbs-up upvotereply up-vote';
                            reply_down_classes  = 'flicon flaticon-thumbs-up downvotereply votedown';
                        }
                    } 
                    else {
                        reply_up_classes    = 'flicon flaticon-thumbs-up showregisterbox';
                        reply_down_classes  = 'flicon flaticon-thumbs-up showregisterbox';
                    }
                    
                    $opinion    =   '<span><i data-id="' + res.replies[j].id + '" data-username="'+res.replies[j].username+'" class="'+reply_up_classes+'"></i></span>' 
                                    + '<span>' + res.replies[j].points + '</span>' 
                                    + '<span><i data-id="' + res.replies[j].id + '" data-username="'+res.replies[j].username+'" class="'+reply_down_classes+'"></i></span>';

                    $replies    +=  '<li class="comment-replies">' 
                                        + '<div class="profilepic">' 
                                            + '<img src="' + res.replies[j].user_dp + '" alt="lp" class="thumb">' 
                                        + '</div>'

                                        + '<div class="replies">'
                                            + '<div class="blockquote">' 
                                                + '<header class="meta">' 
                                                    + '<a target="_blank" href="/s/' + res.replies[j].username + '">' + res.replies[j].username + '</a>'
                                                    + '<span>'+res.replies[j].at+'</span>'
                                                    +$reply_actions
                                                + '</header>'
                                                
                                                +'<div class="reply-body">'
                                                    +'<p class="reply">'+res.replies[j].comment+'</p>'
                                                +'</div>'

                                                + '<footer>' 
                                                    + '<div class="viewer-opinion">' 
                                                        + $opinion
                                                    + '</div>' 
                                                + '</footer>' 
                                            + '</div>' 
                                        + '</div>' 
                                    + '</li>';
                }
            }

            $($target).parents('ul').append($replies);
        }
    })).then(function() {
        
        var $replies_count  =   $($target).parent('ul').children('.comment-replies').length;
        if ($replies_count < count) {
            var $load_more  =   '<span href="#" data-cid="' + c_id + '" data-offset="' + $replies_count + '" class="load-more-replies">Load More Replies</span>';
            $($target).parents('ul').append($load_more);
        }
        $($target).remove();
        rebindLoadMoreReplies();
    });
}

function rebindLoadMoreReplies(){
    $(".load-more-replies").unbind('click', loadMoreReplies);
    $(".load-more-replies").on('click', loadMoreReplies);
    
    $(".upvotereply").unbind('click', upvoteReply);
    $(".downvotereply ").unbind('click', downVoteReply);
    $(".upvotereply").on('click', upvoteReply);
    $(".downvotereply ").on('click', downVoteReply);
    
    
    $(".showregisterbox").unbind('click', showRegisterOptions);
    $(".showregisterbox").on('click', showRegisterOptions);
    
    $(".remove-reply").unbind('click', removePostReply);
    $(".remove-reply").on('click', removePostReply);
    
    $(".report-reply").unbind('click', reportCommentReply);
    $(".report-reply").on('click', reportCommentReply);
    
    $(".edit-reply").unbind('click', editReply);
    $(".edit-reply").on('click', editReply);
    console.log("Load More Replies Rebineded");
}
$("#load-comments").on('click', loadMoreComments);

function loadMoreComments(event) {
    event.preventDefault();
    var $target = $(this),
        $p_id = $($target).attr('data-pid'),
        $offset = $($target).attr('data-offset');

    $.ajax({
        type: 'POST',
        url: '/load/comments',
        data: {
            offset: $offset,
            post_id: $p_id
        },
        success: function(res) {
            if (res.status) {
    
                $($target).parent().fadeOut('slow').remove();
                
                var $opinion            = '',   // comment up/down vote DOM
                    $comment            = '',   // comments DOM
                    $r_opinion          = '',   // reply up/down vote DOM
                    $replies            = '',   // replies DOM
                    $loadmore_replies   = '',   // Load More Replies
                    
                    
                    $comment_options    = '',   // remove post dropdown DOM
                    $comment_delete     = '',
                    $comment_report     = '',
                    $comment_edit       = '',
                    
                    
                    
                    $reply_options      = '',   // remove replies dropdown DOM
                    $reply_delete       = '',
                    $reply_report       = '',
                    $reply_edit         = '',
                    
                    class_up_replies    = '',   // reply up vote DOM classes
                    classes_down_replies= '';   // reply down vote DOM classes
                        
                        
                for (var i = 0; i < res.comments.length; i++) {
                    $opinion            = '',
                    $r_opinion          = '',
                    $replies            = '',
                    $loadmore_replies   = '',
                    $comment_options    = '',
                    $comment_delete     = '',
                    $comment_report     = '',
                    
                    $reply_options      = '';
                    $reply_delete       = '';
                    $reply_report       = '';
                    
                    /*
                    |   if reply comment count for comment increase by 5
                    |   add load more replies option
                    */
                    $loadmore_replies   =   (res.comments[i].reply_count > 5) ? '<span href="#" data-cid="' + res.comments[i].id + '" data-offset="5" class="load-more-replies">Load More Replies</span>' : ''; 

                    if (res.comments[i].replies.length) {
                        
                        for (var j = 0; j < res.comments[i].replies.length; j++) {
                        
                            
                            $reply_delete   =   (res.comments[i].replies[j].owner) ? '<a class="remove-reply" data-cid="'+res.comments[i].id+'" data-rid="'+res.comments[i].replies[j].id+'" >Delete Comment</a>' : '';
                            $reply_report   =   (res.auth) ? (!res.comments[i].replies[j].owner) ? '<a class="report-reply" data-cid="'+res.comments[i].id+'" data-rid="'+res.comments[i].replies[j].id+'" >Report Comment</a>' : '' : '<a class="showregisterbox" data-cid="'+res.comments[i].id+'" data-rid="'+res.comments[i].replies[j].id+'" >Report Comment</a>';
                            $reply_edit     =   (res.comments[i].replies[j].owner) ? '<a class="edit-reply" data-cid="'+res.comments[i].id+'" data-rid="'+res.comments[i].replies[j].id+'" >Edit Comment</a>' : '';

                            $reply_options  =   '<div class="replyactions">'
                                                    +'<ul class="dropdown">'
                                                        +'<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="flicon flaticon-caret"></i> </a>'
                                                        +'<ul class="dropdown-menu dropdown-menu-right">'
                                                            +$reply_delete
                                                            +$reply_report
                                                            +$reply_edit
                                                        +'</ul>'
                                                    +'</ul>'
                                                +'</div>';                           
                            
                            class_up_replies        = '',
                            classes_down_replies    = '';
                                
                            if(res.auth){
                                if (res.comments[i].replies[j].up) {
                                    class_up_replies = 'flicon flaticon-thumbs-up upvotereply checked unvote';
                                    classes_down_replies = 'flicon flaticon-thumbs-down downvotereply votedown';
                    
                                } else if (res.comments[i].replies[j].down) {
                                    class_up_replies = 'flicon flaticon-thumbs-up upvotereply up-vote';
                                    classes_down_replies = 'flicon flaticon-thumbs-down downvotereply checked unvotedown';
                                }
                                else{
                                    class_up_replies = 'flicon flaticon-thumbs-up upvotereply up-vote';
                                    classes_down_replies = 'flicon flaticon-thumbs-down downvotereply votedown';
                                }
                            }else{
                                class_up_replies = 'flicon flaticon-thumbs-up showregisterbox';
                                classes_down_replies = 'flicon flaticon-thumbs-down showregisterbox';
                            }
                        
                            $r_opinion  =   '<span><i data-id="' + res.comments[i].replies[j].id + '" data-username="'+res.comments[i].replies[j].username+'" class="'+class_up_replies+'"></i></span>' 
                                            + '<span>' + res.comments[i].replies[j].points + '</span>' 
                                            + '<span><i data-id="' + res.comments[i].replies[j].id + '" data-username="'+res.comments[i].replies[j].username+'" class="'+classes_down_replies+'"></i></span>';

                            $replies    +=  '<li class="comment-replies">' 
                                                + '<div class="profilepic">' 
                                                    + '<img src="' + res.comments[i].replies[j].user_dp + '" alt="lp" class="thumb">' 
                                                + '</div>'
                                            
                                                + '<div class="replies">' 
                                                    + '<div class="blockquote">'
                                                        + '<header class="meta">' 
                                                            + '<a target="_blank" href="/s/' + res.comments[i].replies[j].username + '">' + res.comments[i].replies[j].username + '</a>' 
                                                            + '<span>'+res.comments[i].replies[j].at+'</span>'
                                                            +$reply_options
                                                        + '</header>'
                                                        
                                                        
                                                        +'<div class="reply-body">'
                                                            +'<p class="reply">'+res.comments[i].replies[j].comment+'</p>'
                                                        +'</div>'
                                                        
                                                        + '<footer>' 
                                                            + '<div class="viewer-opinion">' + $r_opinion + '</div>' 
                                                        + '</footer>' 
                                                    + '</div>' 
                                                + '</div>' 
                                            + '</li>';
                        }
                    }else{
                        $replies    = '';
                    }
                    
                    $comment_delete  = (res.comments[i].owner) ? '<a class="remove-comment" data-cid="'+res.comments[i].id+'" >Delete Comment</a>' : '';
                    
                    $comment_report  = (res.auth) ? (!res.comments[i].owner) ? '<a class="report-comment" data-cid="'+res.comments[i].id+'" >Report Comment</a>' : '' : '<a class="showregisterbox" data-cid="'+res.comments[i].id+'" >Report Comment</a>' ;
                    
                    $comment_edit    = (res.comments[i].owner) ? '<a class="edit-comment" data-cid="'+res.comments[i].id+'" >Edit Comment</a>' : '';
                    
                    $comment_options =  '<div class="commentactions">'
                                            + '<ul class="dropdown">'
                                                + '<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="flicon flaticon-caret"></i> </a>'
                                                + '<ul class="dropdown-menu dropdown-menu-right">'
                                                    + $comment_delete
                                                    +$comment_report
                                                    +$comment_edit
                                                + '</ul>'
                                            + '</ul>'
                                        + '</div>'
                    
                    
                    
                    var class_up_comments   = '',
                        class_down_comments = '',
                        class_reply_comment = '';
                    
                    if (res.auth) {
                        if (res.comments[i].up) {
                            class_up_comments   = 'flicon flaticon-thumbs-up upvotecomment checked unvote';
                            class_down_comments = 'flicon flaticon-thumbs-down downvotecomment votedown';
                            class_reply_comment = '<a href="#" data-id="' + res.comments[i].id + '" class="reply-comment">Reply</a>';
                        } 
                        else if (res.comments[i].down) {
                            class_up_comments   = 'flicon flaticon-thumbs-up upvotecomment up-vote';
                            class_down_comments = 'flicon flaticon-thumbs-down downvotecomment checked unvotedown';
                            class_reply_comment = '<a href="#" data-id="' + res.comments[i].id + '" class="reply-comment">Reply</a>';
                        } 
                        else {
                            class_up_comments   = 'flicon flaticon-thumbs-up upvotecomment up-vote';
                            class_down_comments = 'flicon flaticon-thumbs-down downvotecomment votedown';
                            class_reply_comment = '<span data-id="' + res.comments[i].id + '" class="reply-comment">Reply</a>';
                        }
                    } 
                    else {
                        class_up_comments   = 'flicon flaticon-thumbs-up showregisterbox';
                        class_down_comments = 'flicon flaticon-thumbs-down showregisterbox';
                        class_reply_comment = '';
                    }
                    
                    $opinion    =   '<span href="#"><i data-id="' + res.comments[i].id + '" data-username="'+res.comments[i].username +'" class="'+class_up_comments+'"></i></span>' 
                                    + '<span>' + res.comments[i].points + '</span>' 
                                    + '<span href="#"><i data-id="' + res.comments[i].id + '" data-username="'+res.comments[i].username +'" class="'+class_down_comments+'"></i></span>'
                                    +class_reply_comment;

                    $comment    +=   '<ul>' 
                                        + '<li>' 
                                            + '<div class="profilepic">' 
                                                + '<img src="'+res.comments[i].comment_user_dp+'" alt="lp" class="thumb">' 
                                            + '</div>'

                                            + '<div class="comments">' 
                                                + '<div class="blockquote">' 
                                                    + '<header class="meta">' 
                                                        + '<a target="_blank" href="/s/{{$comment->username}}">' + res.comments[i].username + '</a>'
                                                        + '<span>'+res.comments[i].at+'</span>'
                                                        + $comment_options
                                                    + '</header>'
                                                    
                                                    +'<div class="comment-body">'
                                                        + '<p class="comment">' 
                                                            + res.comments[i].comment 
                                                        + '</p>'
                                                    +'</div>'

                                                    + '<footer>' 
                                                        + '<div class="viewer-opinion">' 
                                                            + $opinion
                                                        + '</div>' 
                                                    + '</footer>' 
                                                + '</div>' 
                                            + '</div>' 
                                        + '</li>' 
                                    + $replies 
                                    + $loadmore_replies 
                                + '</ul>';                    
                }
                
                $($comment).appendTo("#comments");
                
                if(res.reply_count > res.off_set){
                    var $load_more_comments =   '<div id="load-more-wrapper">' 
                                                + '<span href="#" data-pid="' + $p_id + '" data-offset="' + res.off_set + '" id="load-comments">Load More Comments</span>' 
                                            + '</div>';
                    $($load_more_comments).appendTo(".post");
                }
        
                rebindLoadMoreCommentEvents();
            }
        }
    });
}


function rebindLoadMoreCommentEvents(){
    $(".upvotecomment").unbind('click', upvoteComment);
    $(".downvotecomment").unbind('click', downVoteComment);
    $(".upvotecomment").on('click', upvoteComment);
    $(".downvotecomment").on('click', downVoteComment);

    $(".upvotereply").unbind('click', upvoteReply);
    $(".downvotereply ").unbind('click', downVoteReply);
    $(".upvotereply").on('click', upvoteReply);
    $(".downvotereply ").on('click', downVoteReply);
    
    $("#load-comments").unbind('click', loadMoreComments);
    $("#load-comments").on('click', loadMoreComments);

    $(".reply-comment").unbind('click', generateCommentReplyForm);
    $(".reply-comment").on('click', generateCommentReplyForm);

    $(".load-more-replies").unbind('click', loadMoreReplies);
    $(".load-more-replies").on('click', loadMoreReplies);
    
    $(".showregisterbox").unbind('click', showRegisterOptions);
    $(".showregisterbox").on('click', showRegisterOptions);
    
    $(".remove-comment").unbind('click', removePostComment);
    $(".remove-comment").on('click', removePostComment);
    
    $(".remove-reply").unbind('click', removePostReply);
    $(".remove-reply").on('click', removePostReply);
    
    $(".report-reply").unbind('click', reportCommentReply);
    $(".report-reply").on('click', reportCommentReply);


    $(".report-comment").unbind('click', reportPostComment);
    $(".report-comment").on('click', reportPostComment);

    $(".edit-comment").unbind('click', editComment);
    $(".edit-comment").on('click', editComment);

    
    $(".edit-reply").unbind('click', editReply);
    $(".edit-reply").on('click', editReply);
}

$("#post-comment").on('focus', function (event) {
    var $target = $(this),
            $actions = $(this).parent().siblings(".actions");

    $($actions).slideDown('fast');
    $($target).attr('placeholder', 'Leave a comment');
});

$("#post-comment").on('blur', function (event) {
    var $target = $(this),
            $actions = $(this).parent().siblings(".actions");

    if ($target.val().length > 0) {

    } else {
        $($actions).slideUp('fast');
        $($target).attr('placeholder', 'Write Comments!');
    }
});



/*
 |   Submit Comment Button
 */


$("#submit-comment").on('click', function (event) {
    event.preventDefault();
    var $comment = $("#post-comment"),
            $post_id = $($comment).attr('data-pid');
            var show_user=1;
    if ($('#show_user').is(':checked')) {
        show_user = 0;
    }
    if ($comment.val().length > 0) {
        var $target = $(this);
       // console.log(show_user);
        
        $($target).attr('disabled', true);

        $.ajax({
            type: 'POST',
            url: '/post/comment',
            data: {
                comment: $comment.val(),
                post_id: $post_id,
                show_user: show_user
            },
            success: function (res) {
                if (res.status) {
//                    console.log(res);
//                    if(!res.show_user){
//                        res.user.dp_uri=''
//                        res.user.username='Anonymous';
//                    }
                    var $comment_dom = '<ul>'
                            + '<li>'
                            + '<div class="profilepic">'
                            + '<img src="' + res.user.dp_uri + '" alt="lp" class="thumb">'
                            + '</div>'

                            + '<div class="comments">'
                            + '<div class="blockquote">'
                            + '<header class="meta">'
                            + '<a target="_blank" href="/s/' + res.user.username + '">'
                            + res.user.username
                            + '</a>'
                            + '<span>Now</span>'
                            + '<div class="commentactions">'
                            + '<ul class="dropdown">'
                            + '<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="flicon flaticon-caret"></i> </a>'
                            + '<ul class="dropdown-menu dropdown-menu-right">'
                            + '<a class="remove-comment" data-cid="' + res.id + '" >Delete Comment</a>'
                            + '<a class="edit-comment" data-cid="' + res.id + '" >Edit Comment</a>'
                            + '</ul>'
                            + '</ul>'
                            + '</div>'

                            + '</header>'

                            + '<div class="comment-body">'
                            + '<p class="comment">'
                            + $comment.val()
                            + '</p>'
                            + '</div>'

                            + '<footer>'

                            + '<div class="viewer-opinion">'
                            + '<span href="#"><i data-username="' + res.user.username + '" data-id="' + res.id + '" class="flicon flaticon-thumbs-up upvotecomment up-vote"></i></span>'
                            + '<span>0</span>'
                            + '<span href="#"><i data-username="' + res.user.username + '" data-id="' + res.id + '" class="flicon flaticon-thumbs-down downvotecomment votedown"></i></span>'
                            + ' <span href="#" data-id="' + res.id + '" class="reply-comment">Reply</span>'
                            + '</div>'
                            + '</footer>'
                            + '</div>'
                            + '</div>'
                            + '</li>'
                            + '</ul>';

                    $($comment_dom).hide().prependTo("#comments").fadeIn('slow');

                    $($comment).val('');
                    $($comment).blur();

                    rebindPostCommentEvents();
                }

                $($target).attr('disabled', false);
            }
        });
    } else {
        $($comment).attr('placeholder', 'Required...');
    }

});

function rebindPostCommentEvents() {

    $(".upvotecomment").unbind('click', upvoteComment);
    $(".downvotecomment").unbind('click', downVoteComment);
    $(".upvotecomment").on('click', upvoteComment);
    $(".downvotecomment").on('click', downVoteComment);

    $(".reply-comment").unbind('click', generateCommentReplyForm);
    $(".reply-comment").on('click', generateCommentReplyForm);

    $(".remove-comment").unbind('click', removePostComment);
    $(".remove-comment").on('click', removePostComment);

    $(".edit-comment").unbind('click', editComment);
    $(".edit-comment").on('click', editComment);
}

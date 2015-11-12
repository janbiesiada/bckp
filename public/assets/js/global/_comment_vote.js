/*
|   UpVote Comment, check if upvoted, removed down vote checked class!
*/


$(".upvotecomment").on('click', upvoteComment);


function upvoteComment(event) {
    event.preventDefault();
    var $target     = $(this),
        $comment_id = $($target).attr('data-id'),
        $username   = $($target).attr('data-username'),
        $dvote      = $($target).parent().parent().children('span').eq(2).children('i'),
        $points     = $($target).parent().parent().children('span').eq(1);

    if ($($dvote).hasClass('checked')) {
        
        $($target).unbind('click', upvoteComment);
        $.ajax({
            type: 'POST',
            url: '/vote',
            data: {
                action  :   'update_to_upvote',
                id      :   $comment_id,
                target  :   'comment',
                owner   :   $username
            },
            success: function(res) {
                if (res.action) {
                    $($target).removeClass('up-vote').addClass('checked').addClass('unvote');
                    $($dvote).removeClass('unvotedown checked').addClass('votedown');
                    $($points).html(res.count);
                }
                $($target).bind('click', upvoteComment);
            }
        });
    } else {
        if ($($target).hasClass('unvote')) {
            $($target).unbind('click', upvoteComment);
            $.ajax({
                type: 'POST',
                url: '/vote',
                data: {
                    action  :   'unvote',
                    id      :   $comment_id,
                    target  :   'comment',
                    owner   :   $username,
                    u_vote  : 'up'
                },
                success: function(res) {

                    if (res.action) {
                        $($target).removeClass('unvote').removeClass('checked').addClass('up-vote');
                        $($points).html(res.count);
                    }
                    $($target).bind('click', upvoteComment);
                }
            });
        }

        if ($($target).hasClass('up-vote')) {
            $($target).unbind('click', upvoteComment);
            $.ajax({
                type: 'POST',
                url: '/vote',
                data: {
                    action  :   'vote',
                    id      :   $comment_id,
                    target  :   'comment',
                    owner   :   $username
                },
                success: function(res) {
                    if (res.action) {
                        $($target).removeClass('up-vote').addClass('checked').addClass('unvote');
                        $($points).html(res.count);
                    }
                    
                    $($target).bind('click', upvoteComment);
                }
            });
        }
    }
}


/*
|   Downvote Comment, check if upvoted, removed down vote checked class!
*/


$(".downvotecomment").on('click', downVoteComment);

function downVoteComment(event) {
    event.preventDefault();
    var $target     = $(this),
        $comment_id = $($target).attr('data-id'),
        $username   = $($target).attr('data-username'),
        $uvote      = $($target).parent().parent().children('span').eq(0).children('i'),
        $points     = $($target).parent().parent().children('span').eq(1);


    if ($($uvote).hasClass('checked')) {
        $($target).unbind('click', downVoteComment);
        $.ajax({
            type: 'POST',
            url: '/vote',
            data: {
                action  :   'update_to_downvote',
                id      :   $comment_id,
                target  :   'comment',
                owner   :   $username
            },
            success: function(res) {

                if (res.action) {
                    $($target).removeClass('votedown').addClass('checked').addClass('unvotedown');
                    $($uvote).removeClass('checked unvote').addClass('up-vote');
                    $($points).html(res.count);
                }
                $($target).bind('click', downVoteComment);
            }
        });
    } else {
        if ($($target).hasClass('unvotedown')) {
            $($target).unbind('click', downVoteComment);
            $.ajax({
                type: 'POST',
                url: '/vote',
                data: {
                    action  :   'unvote',
                    id      :   $comment_id,
                    target  :   'comment',
                    owner   :   $username,
                    u_vote  : 'down'
                },
                success: function(res) {

                    if (res.action) {
                        $($target).removeClass('unvotedown').removeClass('checked').addClass('votedown');
                        $($points).html(res.count);

                    }
                    $($target).bind('click', downVoteComment);
                }
            });
        }

        if ($($target).hasClass('votedown')) {
            $($target).unbind('click', downVoteComment);
            $.ajax({
                type: 'POST',
                url: '/vote',
                data: {
                    action  :   'downvote',
                    id      :   $comment_id,
                    target  :   'comment',
                    owner   :   $username
                },
                success: function(res) {

                    if (res.action) {
                        $($target).removeClass('votedown').addClass('checked').addClass('unvotedown');
                        $($points).html(res.count);
                    }
                    $($target).bind('click', downVoteComment);
                }
            });
        }
    }
}
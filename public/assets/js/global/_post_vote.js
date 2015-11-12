$(".upvote").on('click', upvote);

function upvote(event) {
    event.preventDefault();
    var $target         = $(this),
        $post_id        = $($target).attr('data-pid'),
        $username       = $($target).attr('data-username'),
        $dvote          = $($target).parent().parent().siblings('li').eq(0).children('span').children('i'),
        $points         = $($target).parent().parent().siblings('li').children(".totalpoints");

    if ($($dvote).hasClass('checked')) {
        $($target).unbind('click',upvote);
        $.ajax({
            type: 'POST',
            url: '/vote',
            data: {
                action  : 'update_to_upvote',
                id      : $post_id,
                target  : 'post',
                owner   : $username
            },
            success: function(res) {
                if (res.action) {
                    $($target).removeClass('up-vote').addClass('checked').addClass('unvote');
                    $($dvote).removeClass('unvotedown checked').addClass('votedown');
                    $($points).html(res.count);
                }
                $($target).bind('click',upvote);
            }
        });
    } else {
        if ($($target).hasClass('unvote')) {
            $($target).unbind('click',upvote);
            $.ajax({
                type: 'POST',
                url: '/vote',
                data: {
                    action  : 'unvote',
                    id      : $post_id,
                    target  : 'post',
                    owner   : $username,
                    u_vote  : 'up'
                },
                success: function(res) {

                    if (res.action) {
                        $($target).removeClass('unvote').removeClass('checked').addClass('up-vote');
                        $($points).html(res.count);
                    }
                    $($target).bind('click',upvote);
                }
            });
        }

        if ($($target).hasClass('up-vote')) {
            $($target).unbind('click',upvote);
            $.ajax({
                type: 'POST',
                url: '/vote',
                data: {
                    action  : 'vote',
                    id    : $post_id,
                    target  : 'post',
                    owner   : $username
                },
                success: function(res) {
                    if (res.action) {
                        $($target).removeClass('up-vote').addClass('checked').addClass('unvote');
                        $($points).html(res.count);
                    }
                    
                    $($target).bind('click',upvote);
                }
            });
        }
    }
}


/*
|   Down Vote post, check if upvoted, removed down vote checked class!
*/


$(".downvote").on('click', downvote);


function downvote(event) {
    event.preventDefault();
    var $target     = $(this),
        $post_id    = $($target).attr('data-pid'),
        $username   = $($target).attr('data-username'),
        $uvote      = $($target).parent().parent().siblings('li').eq(0).children('span').children('i'),
        $points     = $($target).parent().parent().siblings('li').children(".totalpoints");

    if ($($uvote).hasClass('checked')) {
        $($target).unbind('click',downvote);
        $.ajax({
            type: 'POST',
            url: '/vote',
            data: {
                action  : 'update_to_downvote',
                id      : $post_id,
                target  : 'post',
                owner   : $username
            },
            success: function(res) {

                if (res.action) {
                    $($target).removeClass('votedown').addClass('checked').addClass('unvotedown');
                    $($uvote).removeClass('checked unvote').addClass('up-vote');
                    $($points).html(res.count);
                }
                $($target).bind('click',downvote);
            }
        });
    } else {
        if ($($target).hasClass('unvotedown')) {
            $($target).unbind('click',downvote);
            $.ajax({
                type: 'POST',
                url: '/vote',
                data: {
                    action  : 'unvote',
                    id      : $post_id,
                    target  : 'post',
                    owner   : $username,
                    u_vote  : 'down'
                },
                success: function(res) {

                    if (res.action) {
                        $($target).removeClass('unvotedown').removeClass('checked').addClass('votedown');
                        $($points).html(res.count);

                    }
                    $($target).bind('click',downvote);
                }
            });
        }

        if ($($target).hasClass('votedown')) {
            $($target).unbind('click',downvote);
            $.ajax({
                type: 'POST',
                url: '/vote',
                data: {
                    action  : 'downvote',
                    id      : $post_id,
                    target  : 'post',
                    owner   : $username
                },
                success: function(res) {

                    if (res.action) {
                        $($target).removeClass('votedown').addClass('checked').addClass('unvotedown');

                        $($points).html(res.count);
                    }
                    $($target).bind('click',downvote);
                }
            });
        }
    }
}
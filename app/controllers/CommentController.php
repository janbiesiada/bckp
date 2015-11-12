<?php

class CommentController extends BaseController {

    public function postComment() {

        $comment = Input::get('comment');            // comment text
        $p_id = Input::get('post_id');            // post p_id
        $show_user = Input::get('show_user');            // If user chose to be anonymous or not        
        $user = Session::get('auth')['username']; // authenticated user's username
        $after_check_commnet=CommentController::maliciousPrevent($comment);
        /*
          |   Create New Comment
         */
        $post_comment = new Comment;
        $post_comment->p_id = $p_id;
        $post_comment->username = $user;
        $post_comment->comment = $comment;
        $post_comment->show_user = $show_user;
        $post_comment->points = 0;
       
if ($post_comment->save()) {
            /*
              | Create Comment Notification
             */
            Notify::comment($p_id, $user);
            if ($show_user) {
                return Response::json(array(
                            'status' => true,
                            'user' => Session::get('auth'),
                            'id' => $post_comment->id,
                            'show_user' => $post_comment->show_user
                ));
            } else {
                
                return Response::json(array(
                            'status' => true,
                            'user' => array('username'=>'Anonymous','dp_uri'=>URL::secure('/assets/uploads').'/no_image.jpeg'),
                            'id' => $post_comment->id,
                            'show_user' => $post_comment->show_user
                ));
            }
        } else {
            /*
              |   return NULL if comment save not successfull
             */
            return Reponse::json(false);
        }
    }
    /*
      | prevent comments from malicious code 
     */
static function maliciousPrevent($string)
     {
           $remo_space=trim($string);
           $second_check=strip_tags($remo_space);
           // comment is now safe for storage
           file_put_contents("comments.txt", $second_check, FILE_APPEND);
            // escape comments before display
             $comments = file_get_contents("comments.txt");
             $fist_check=htmlspecialchars($comments,ENT_QUOTES,'UTF-8');
            return $fist_check;
     
     
     }
    /*
      | XHR Load More Comments
     */

    public function loadMore() {
        $p_id = Input::get('post_id');    //  p_id for loading comments
        $offset = Input::get('offset');     //  total numbers of loaded comments
        $new_offset = $offset + 5;                //  new offset to load new comments
        $session = false;                    //  Session default value


        $comments = Comment::orderBy('points', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->where('p_id', $p_id)
                ->skip($offset)
                ->take($new_offset)
                ->get();

        $reply_count = Comment::orderBy('points', 'DESC')
                ->where('p_id', '=', $p_id)
                ->count();

        if ($comments->count()) { // if comments found for post
            $i = 0;
            foreach ($comments as $comment) {

                $this->getCommentUserDp($comments[$i]);
                $this->verifyCommentOwner($comments[$i]);
                $this->commentTimeStamp($comments[$i]);
                $this->initCommentProps($comments[$i]);
                $this->validateCommentVotes($comments[$i]);
                $this->commentReplies($comments[$i]);
                $this->commentReplyCount($comments[$i]);
                $i++;
            }
            /*
              |   check if user is authenticated
             */
            if (Session::has('auth')) {
                $session = true;
            } else {
                $session = false;
            }

            return Response::json(array(
                        'status' => true,
                        'comments' => $comments,
                        'auth' => $session,
                        'off_set' => $new_offset,
                        'reply_count' => $reply_count
            ));
        }
    }

    /**
     * Update Comment
     */
    public function updateComment() {
        if (Authenticate::hasAuth()) {
            $update = Comment::where('id', '=', Input::get('cid'))
                    ->update(array(
                'comment' => Input::get('comment')
            ));

            if ($update) {
                return Response::json(true);
            } else {
                return Response::json(false);
            }
        }
    }

    /**
     * Get Comment User Profile Picture
     */
    public function getCommentUserDp(&$comment) {
        $comment->comment_user_dp = User::where('username', '=', $comment->username)
                        ->first()
                ->dp_uri;
    }

    /**
     * Verify Comment Owner
     */
    public function verifyCommentOwner(&$comment) {
        $comment->owner = (Session::has('auth')) ? ((Session::get('auth')['username'] === $comment->username) ? true : false) : false;
    }

    /**
     * Comment Time Stamp
     */
    public function commentTimeStamp(&$comment) {

        $ago = date('Y-m-d H:i:s', strtotime($comment->created_at));
        $UTC = new DateTimeZone("UTC");
        $newTZ = new DateTimeZone(Session::get('timezone'));
        $date = new DateTime($ago, $UTC);
        $date->setTimezone($newTZ);
        $comment->at = TimeZoneController::getElapsedTime($date->format('Y-m-d H:i:s'));
    }

    /**
     * Comment Properties Defaults
     */
    public function initCommentProps(&$comment) {
        $comment->up = false;
        $comment->down = false;
    }

    /**
     * Validate Comment Votes
     */
    public function validateCommentVotes(&$comment) {
        $comment_vote = Vote::where('target', $comment->id)
                ->where('type', 'comment')
                ->where('username', Session::get('auth')['username'])
                ->get();

        if ($comment_vote->count()) {

            $comment->up = ($comment_vote->first()->up == 1) ? true : false;

            $comment->down = ($comment_vote->first()->down == 1) ? true : false;
        }
    }

    /**
     * Comment Reply Count
     */
    public function commentReplyCount(&$comment) {
        $reply_count = DB::table('commentReplies')
                ->select(DB::raw('count(*) as commentcount'))
                ->where('comment_id', '=', $comment->id)
                ->get();

        $comment->reply_count = $reply_count[0]->commentcount;
    }

    /**
     * Comment Replies
     */
    public function commentReplies(&$comment) {
        $comment->replies = Reply::where('comment_id', '=', $comment->id)
                ->skip(0)
                ->take(5)
                ->get();
        if ($comment->replies->count()) {
            $k = 0;
            foreach ($comment->replies as $reply) {

                $this->getReplyUserDp($comment->replies[$k]);
                $this->verifyReplyOwner($comment->replies[$k]);
                $this->replyTimeStamps($comment->replies[$k]);
                $this->validateReplyVotes($comment->replies[$k]);

                $k++;
            }
        }
    }

    /**
     * Reply User Profile Pic
     */
    public function getReplyUserDp(&$reply) {
        $reply->user_dp = User::where('username', '=', $reply->username)
                        ->first()
                ->dp_uri;
    }

    /**
     * Verify Reply Ownership for 
     * Editing/Delete Functions
     */
    public function verifyReplyOwner(&$reply) {
        $reply->owner = (Session::has('auth') ? ((Session::get('auth')['username'] === $reply->username) ? true : false) : false);
    }

    /**
     * Reply Timestamps
     */
    public function replyTimeStamps(&$reply) {
        $ago = date('Y-m-d H:i:s', strtotime($reply->created_at));
        $UTC = new DateTimeZone("UTC");
        $newTZ = new DateTimeZone(Session::get('timezone'));
        $date = new DateTime($ago, $UTC);
        $date->setTimezone($newTZ);
        $reply->at = TimeZoneController::getElapsedTime($date->format('Y-m-d H:i:s'));
    }

    /**
     * Validate Reply Votes
     */
    public function validateReplyVotes(&$reply) {
        $reply->up = false;     // reply upvote     _DEFAULT
        $reply->down = false;     // reply downvote   _DEFAULT

        $reply_votes = Vote::where('target', $reply->id)
                ->where('type', 'reply')
                ->where('username', Session::get('auth')['username']);


        if ($reply_votes->count()) {
            $reply->up = ($reply_votes->first()->up == 1) ? true : false;
            $reply->down = ($reply_votes->first()->down == 1) ? true : false;
        }
    }

}

<?php

class ReplyController extends BaseController{
    
    public function postReply(){
        $reply  = Input::get('reply');
        $c_id   = Input::get('c_id'); 
        $user   = Session::get('auth')['username'];
        
        $new_reply = new Reply;
        $new_reply->comment_id  =   $c_id;
        $new_reply->username    =   $user;
        $new_reply->points      =   0;
        $new_reply->comment     =   $reply;
        
        if($new_reply->save()){
            
            
            Notify::reply($c_id,$user);
            return Response::json(array(
                'status'    =>  true,
                'reply_id'  =>  $new_reply->id,
                'user'      =>  Session::get('auth')
            ));
        }else{
            return Response::json(array(
                'status'    =>  false,
                'reply_id'  => ''
            ));
        }
    }
    
    public function loadMore(){
        $comment_id = Input::get('comment_id');
        $offset     = Input::get('d_offset');
        $new_offset = $offset+5;
        $session    = false;
        
        $replies    =   Reply::where('comment_id', '=', $comment_id)
                            ->skip($offset)
                            ->take($new_offset)
                            ->get();
        $reply_count=   $this->replycount($comment_id);
        
        $k=0;
        if($replies->count()){
            foreach($replies as $reply){
                
                $this->replyUserDp($replies[$k]);
                $this->verifyReplyOwner($replies[$k]);
                $this->replyTimeStamp($replies[$k]);
                $this->validateReplyPoints($replies[$k]);

                $k++;
            }
            
            return Response::json(array(
                'status'        =>  true,
                'replies'       =>  $replies,
                'reply_count'   =>  $reply_count,
                'session'        => (Session::has('auth')) ? true : false
            ));
        }else{
            return Response::json(array(
                'status'        =>  'no more',
                'replies'       =>  '',
                'reply_count'   =>  $reply_count
            ));
        }

    }
    
    /**
     * Update Commen Replies
     */
    public function updateReply(){
        if(Authenticate::hasAuth()){
            $update =   Reply::where('id','=',Input::get('rid'))
                            ->update(array(
                                'comment'   => Input::get('reply')
                            ));
            if($update){
                return Response::json(true);
            }else{
                return Response::json(true);
            }
        }
    }
    
    /**
     * Reply count
     */
    public function replycount($comment_id){
        $reply_count    =   DB::table('commentReplies')
                                ->select(DB::raw('count(*) as replycount'))
                                ->where('comment_id', '=', $comment_id)
                                ->get();
        return $reply_count[0]->replycount;
    }
    
    /**
     * Reply User Profile Picture
     */
    public function replyUserDp(&$reply){
        $reply->user_dp   = User::where('username','=',$reply->username)->first()->dp_uri;
    }
    
    /**
     * Verify Reply Owner
     */
    public function verifyReplyOwner(&$reply){
        if($reply->username === Session::get('auth')['username']){
            $reply->owner = true;
        }else{
            $reply->owner = false;
        }
    }
    
    /**
     * Reply Timestamps
     */
    public function replyTimeStamp(&$reply){
        $ago = date('Y-m-d H:i:s', strtotime($reply->created_at));
        $UTC = new DateTimeZone("UTC");
        $newTZ = new DateTimeZone(Session::get('timezone'));
        $date = new DateTime($ago, $UTC );
        $date->setTimezone( $newTZ );
        $reply->at  =   TimeZoneController::getElapsedTime($date->format('Y-m-d H:i:s'));
    }
    
    /**
     * Validate Reply Votes
     */
    public function validateReplyPoints(&$reply){
        $reply->up     = false;
        $reply->down   = false;
                        
        $reply_points   =   Vote::where('target',$reply->id)
                                ->where('type','reply')
                                ->where('username',Session::get('auth')['username'])
                                ->get();
                                    
            
        if($reply_points->count()){
            foreach($reply_points as $r_points){
                if($r_points->up == 1){
                        
                    if($r_points->username === Session::get('auth')['username']){
                        $reply->up = true;
                    }
                            
                }
                                
                if($r_points->down == 1){
                    if($r_points->username === Session::get('auth')['username']){
                        $reply->down = true;
                    }
                }
           }
                
        }
    }
}
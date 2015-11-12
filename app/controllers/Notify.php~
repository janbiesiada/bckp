<?php

class Notify{
    
    
    /**
     * New Notification
     *
     * @params  ($type) content type
     * @params  ($id)   content unique id
     * @user    ($user) action_by authenticated user
     */
    public static function comment($p_id, $user){
        
        $action_for = Post::where('p_id','=',$p_id)->first()->username;
        
        if($action_for != $user){
            $notification   = new Notification;
        
            $notification->action_for   = $action_for;
            $notification->action_by    = $user;
            $notification->action       = 'comment';
            $notification->target       = $p_id;
            $notification->status       = 1;
            
            $notification->save();
        }
    }
     public static function suggestPost($user_id, $follower_id){
      $action_for=User::where('id','=',$follower_id)->first()->username;
      $action_by=User::where('id','=',$user_id)->first()->username;
        if($user_id != $follower_id){
            $notification   = new Notification;
        
            $notification->action_for   = $action_for;
            $notification->action_by    = $action_by;
            $notification->action       = 'suggestedpost';
            $notification->target       = 'suggestingposts';
            $notification->status       = 1;
            $notification->save();
        }
    }
     public static function removePic($target, $username){
       if($target !=  $username){
            $notification   = new Notification;
            $notification->action_for   = $target;
            $notification->action_by    = 'Visual Hierarchy Admin';
            $notification->action       = 'removeprofile';
            $notification->target       = 'user-profile';
            $notification->status       = 1;
            $notification->save();
        }
    }
    
    public static function postvote($p_id,$user){
        $action_for = Post::where('p_id','=',$p_id)->first()->username;
        
        if($action_for != $user){
            $notification   = new Notification;
            
            $notification->action_for   = $action_for;
            $notification->action_by    = $user;
            $notification->action       = 'postlike';
            $notification->target       = $p_id;
            $notification->status       = 1;
            
            $notification->save();
        }
    }
    
    public static function remove_postvote($p_id,$user){
        
        $action_for = Post::where('p_id','=',$p_id)->first()->username;
        
        $notification = Notification::where('action_for','=', $action_for)
                                    ->where('action_by', '=', $user)
                                    ->where('action','=','postlike')
                                    ->where('target','=',$p_id);
        $notification->delete();
    }
    
    public static function commentvote($c_id, $user){
        $action_for = Comment::where('id','=',$c_id)->first()->username;
        
        $notification   = new Notification;
        if($action_for != $user){
        
            $notification->action_for   = $action_for;
            $notification->action_by    = $user;
            $notification->action       = 'commentlike';
            $notification->target       = $c_id;
            $notification->status       = 1;
            
            $notification->save();
        }
    }
    
    public static function remove_commentvote($c_id,$user){
        
        $action_for = Comment::where('id','=',$c_id)->first()->username;
        
        $notification = Notification::where('action_for','=', $action_for)
                                    ->where('action_by', '=', $user)
                                    ->where('action','=','commentlike')
                                    ->where('target','=',$c_id);
        $notification->delete();
        
    }
    
    public static function replyvote($id,$user){
        $action_for = Reply::where('id','=',$id)->first()->username;
        
        $notification   = new Notification;
        
        if($action_for != $user){
            $notification->action_for   = $action_for;
            $notification->action_by    = $user;
            $notification->action       = 'replylike';
            $notification->target       = $id;
            $notification->status       = 1;

            $notification->save();
        }
    }
    
    public static function remove_replyvote($id,$user){
        
        $action_for = Reply::where('id','=',$id)->first()->username;
        
        $notification = Notification::where('action_for','=', $action_for)
                                    ->where('action_by', '=', $user)
                                    ->where('action','=','replylike')
                                    ->where('target','=',$id);
        $notification->delete();
        
    }
    
    public static function reply($c_id, $user){
        $action_for = Comment::where('id','=',$c_id)->first()->username;
        
        if($action_for != $user){
            $notification = new Notification;
            
            $notification->action_for   = $action_for;
            $notification->action_by    = $user;
            $notification->action       = 'commentreply';
            $notification->target       = $c_id;
            $notification->status       = 1;
            
            $notification->save();
        }
        
        
    }
}

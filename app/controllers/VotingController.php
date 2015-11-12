<?php

class VotingController extends BaseController{
    
    /**
     * Vote Requests
     */
    public function vote(){
        
        /**
         * @Variable    ($target)       Content Type(Post,Comment,Reply)
         * @Variable    ($owner)        Content Owner Username
         * @Variable    ($user)         Authenticated User Username
         * @Variable    ($action)       Action (Upvote,Downvote,Unvote,UnvoteDown,UpdateToDOwn,UpdateToUp)
         * @Variable    ($target_id)    Unique Content Specifier
         */
         
        $target     =   Input::get('target');
        $owner      =   Input::get('owner');
        $user       =   Session::get('auth')['username'];
        $action     =   Input::get('action');
        $target_id  =   Input::get('id');
            
        if($action === "vote"){
            if(!PointsController::RecordExist($owner,$target)){
                PointsController::createEmptyRecord($owner,$target);
                PointsController::incremenetPoints($owner,$target);
            }else{
                PointsController::incremenetPoints($owner,$target);
            }
            return $this->_vote($target_id,$user,$target,1,0);
        }
            
        if($action === "unvote"){
            $un_type    =   Input::get('u_vote');
            
            if($un_type === "up"){
                if(!PointsController::RecordExist($owner,$target)){
                    PointsController::createEmptyRecord($owner,$target);
                    PointsController::decrementPoints($owner,$target);
                }else{
                    PointsController::decrementPoints($owner,$target);

                }
            }
            
            if($un_type === "down"){
                if(!PointsController::RecordExist($owner,$target)){
                    PointsController::createEmptyRecord($owner,$target);
                    PointsController::incremenetPoints($owner,$target);
                }else{
                    PointsController::incremenetPoints($owner,$target);
                }
            }
            
            return $this->unvote($target_id,$user,$target);
        }
            
        if($action === "downvote"){
            if(!PointsController::RecordExist($owner,$target)){
                PointsController::createEmptyRecord($owner,$target);
                PointsController::decrementPoints($owner,$target);
            }else{
                PointsController::decrementPoints($owner,$target);
            }
            return $this->downvote($target_id,$user,$target,0,1);
        }
            
        if($action === "update_to_downvote"){
            if(!PointsController::RecordExist($owner,$target)){
                PointsController::createEmptyRecord($owner,$target);
                PointsController::decrementPoints($owner,$target);
            }else{
                PointsController::decrementPoints($owner,$target);
                PointsController::decrementPoints($owner,$target);
            }
            return $this->update_to_downvote($target_id,$user,$target,0,1);
        }
            
        if($action === "update_to_upvote"){
            if(!PointsController::RecordExist($owner,$target)){
                PointsController::createEmptyRecord($owner,$target);
                PointsController::incremenetPoints($owner,$target);
            }else{
                PointsController::incremenetPoints($owner,$target);
                PointsController::incremenetPoints($owner,$target);
            }
            return $this->update_to_upvote($target_id,$user,$target,1,0);
        }
        
 
    }
    
    /**
     * Content Upvoted
     * 
     * @params  string  $target     ->Content Unqiue id
     * @params  string  $user       ->Authenticated User
     * @params  string  $type       ->Type of Content Upvoted
     * @parms   string  $up,$down   ->1,0
     */
    public function _vote($target,$user,$type,$up,$down){
        $vote           =   new Vote;
        $vote->target   =   $target;
        $vote->username =   $user;
        $vote->type     =   $type;
        $vote->up       =   $up;
        $vote->down     =   $down;
        
        if($vote->save()){
            /**
             * TODO
             * 
             * Post Like Notification
             * Comment Like Notification
             * Reply like Notification
             */
             
            if($type === "post"){
                Notify::postvote($target, $user);
            }
            
            if($type ===  "comment"){
                Notify::commentvote($target,$user);
            }
            
            if($type === "reply"){
                Notify::replyvote($target,$user);
            }
            $this->updatePoints($type,$target);
            return Response::json(array('action' => true,'count'=> $this->countVotes($type,$target)));
        }else{
            return Response::json(array('action' => false,'count'=> $this->countVotes($type,$target)));
        }
    }
    
    /**
     * Undo Upvoted Content
     * 
     * @params  string  $target     ->Content Unqiue id
     * @params  string  $user       ->Authenticated User
     * @params  string  $type       ->Type of Content Unvoted
     */
    public function unvote($target,$user,$type){
        $unvote =   Vote::where('type','=',$type)
                        ->where('target','=',$target)
                        ->where('username','=',$user)
                        ->delete();
        if($unvote){
            if($type === "post"){
                Notify::remove_postvote($target, $user);
            }
            
            if($type === "comment"){
                Notify::remove_commentvote($target,$user);
            }
            
            if($type === "reply"){
                Notify::remove_replyvote($target,$user);
            }
            $this->updatePoints($type,$target);
            return Response::json(array('action' => true,'count'=> $this->countVotes($type,$target)));
        }else{
            return Response::json(array('action' => false,'count'=> $this->countVotes($type,$target)));
        }
    }
    
    
    /**
     * Content Upvoted
     * 
     * @params  string  $target     ->Content Unqiue id
     * @params  string  $user       ->Authenticated User
     * @params  string  $type       ->Type of Content Upvoted
     * @parms   string  $up,$down   ->0,1
     */
    public function downvote($target,$user,$type,$up,$down){
        $vote           =   new Vote;
        $vote->target   =   $target;
        $vote->username =   $user;
        $vote->type     =   $type;
        $vote->up       =   $up;
        $vote->down     =   $down;
        
        if($vote->save()){
            if($type === "post"){
                Notify::remove_postvote($target, $user);
            }
            
            if($type === "comment"){
                Notify::remove_commentvote($target,$user);
            }
            
            if($type === "reply"){
                Notify::remove_replyvote($target,$user);
            }
            $this->updatePoints($type,$target);
            return Response::json(array('action' => true,'count'=> $this->countVotes($type,$target)));
        }else{
            return Response::json(array('action' => false,'count'=> $this->countVotes($type,$target)));
        }
    }
    
    /**
     * Update Upvoted Content to Downvote
     * 
     * @params  string  $target     ->Content Unqiue id
     * @params  string  $user       ->Authenticated User
     * @params  string  $type       ->Type of Content Upvoted
     * @parms   string  $up,$down   ->0,1
     */
    public function update_to_downvote($target,$user,$type,$up,$down){
        $update =   Vote::where('type','=',$type)
                        ->where('target','=',$target)
                        ->where('username','=',$user)
                        ->update(array(
                            'up'    =>  $up,
                            'down'  =>  $down
                        ));
        if($update){
            
            if($type === "post"){
                Notify::remove_postvote($target, $user);
            }
            
            if($type === "comment"){
                Notify::remove_commentvote($target,$user);
            }
            
            if($type === "reply"){
                Notify::remove_replyvote($target,$user);
            }
            $this->updatePoints($type,$target);
            return Response::json(array('action' => true,'count'=> $this->countVotes($type,$target)));
        }else{
            return Response::json(array('action' => false,'count'=> $this->countVotes($type,$target)));
        }
    }
    
    
    /**
     * Update Upvoted Content to Downvote
     * 
     * @params  string  $target     ->Content Unqiue id
     * @params  string  $user       ->Authenticated User
     * @params  string  $type       ->Type of Content Upvoted
     * @parms   string  $up,$down   ->1,0
     */
    public function update_to_upvote($target,$user,$type,$up,$down){
        $update =   Vote::where('type','=',$type)
                        ->where('target','=',$target)
                        ->where('username','=',$user)
                        ->update(array(
                            'up'    =>  $up,
                            'down'  =>  $down
                        ));
        if($update){
            if($type === "post"){
                Notify::remove_postvote($target, $user);
            }
            
            if($type === "comment"){
                Notify::commentvote($target,$user);
            }
            
            
            if($type === "reply"){
                Notify::replyvote($target,$user);
            }
            
            
            $this->updatePoints($type,$target);
            return Response::json(array('action' => true,'count'=> $this->countVotes($type,$target)));
        }else{
            return Response::json(array('action' => false,'count'=> $this->countVotes($type,$target)));
        }
    }
    
    
    /**
     * Count Content Votes
     * 
     * @params  string $type    ->Type of Media
     * @params  string $target  ->Content Unique ID
     */
    public function countVotes($type,$target){
        $get_points =   Vote::where('type','=',$type)
                            ->where('target','=',$target)
                            ->get();
        
        $points = 0;
        if($get_points->count()){   // if votes found
        
            foreach($get_points as $point){
                if($point->up == 1){
                    $points +=1;
                }
                
                
                if($point->down == 1){
                    $points -=1;
                }
            }
        }
        return $points;
    }
    
    /**
     * Update Content Points
     */
    public function updatePoints($target,$target_id){
        
        if($target === "post"){
            $post   =   Post::where('p_id','=',$target_id)
                            ->update(array(
                                'points'    => $this->countVotes($target,$target_id) 
                            ));
        }
        
        if($target === "comment"){
            $comment    =   Comment::where('id','=',$target_id)
                                    ->update(array(
                                        'points'    => $this->countVotes($target,$target_id)
                                    ));
        }
        
        if($target === "reply"){
            $comment    =   Reply::where('id','=',$target_id)
                                    ->update(array(
                                        'points'    => $this->countVotes($target,$target_id)
                                    ));
        }
    }
}
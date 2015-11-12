<?php

class DeleteController extends BaseController{
    
    /**
     * Post Purge Image URI
     */
    public $uri;
    
    /**
     * Perform Delete Operations.
     */
    public function remove(){
    
        if(Authenticate::hasAuth()){
            /**
             * Action : Delete -> Post
             */
            if(Input::get('target') === "post"){
                
                /**
                 * Purge Post with Unqiue Post ID
                 */
                return $this->purgePost(Input::get('post_id'));
            }
            
            /**
             * Action : Delete -> Comment
             */
            if(Input::get('target') === "comment"){
                
                /**
                 * Purge Comment with Unique Comment ID
                 */
                return $this->purgeComment(Input::get('comment_id'));
            }
            
            /**
             * Action : Delete -> Reply
             */
            if(Input::get('target') === "reply"){
                $c_id = Input::get('cid');
                
                return $this->purgeReply(Input::get('reply_id'));
            }
        }
    }
    
    /**
     * Perform Reply Delete Operation
     * 
     * @param string $reply_id
     * @return bool
     */
     public function purgeReply($rid){
         
        /**
         * Fetch Reply Details
         */ 
        $replies = Reply::where('id','=',$rid)->first();
                
        /**
         * Purge Reply Votes
         */
        $this->purgeVotes('reply','reply_id',$rid);
        
        /**
         * Purge Reply Flagged Reports
         */
        $this->purgeReports('reply',$rid);
        
        /**
         * Purge Reply Notification
         */
        $this->purgeNotification('replylike',$rid);
        $this->purgeNotification('commentreply',$replies->comment_id);
        
        /**
         * Purge Reply
         */
        if($replies->delete()){
            return Response::json(array(
                'status'    => true,
            ));
        }
     }
    
    /**
     * Perform Comment Delete Operation
     *
     * @param string $comment_id
     * @return bool
     */
    public function purgeComment($c_id){
        /**
         * Fetch Comment Details
         */
        $comment = Comment::where('id','=',$c_id);
        
        /**
         * Purge Comment Reports
         */
        $this->purgeReports('comment',$c_id);
    
        /**
         * Purge Comment Votes
         */
        $this->purgeVotes('comment','comment_id',$c_id);
        
        /**
         * Collect Comment Replies
         */
        $replies = Reply::where('comment_id','=',$c_id);
        
        foreach($replies->get() as $reply){
            /**
             * Purge Each Reply
             */
             $this->purgeReply($reply->id);
        }
        /**
         * Purge Comment Notifications
         */
        $this->purgeNotification('comment',$comment->first()->p_id);
        
        /**
         * Purge Comment Like Notification
         */
        $this->purgeNotification('commentlike',$c_id);
        
        /**
         * Purge Comment Reply Notifications
         */
        $this->purgeNotification('commentreply',$c_id);
    
        /**
         * Purge Comment and Replies
         */
        $replies->delete();
        $comment->delete();
        return Response::json(array(
            'status'    => true,
        ));
    }
     
    /**
    * Purge Reply Votes
    * 
    * @param  string  $target
    * @param  string  $holder
    * @param  string  $target
    */
    public function purgeVotes($action,$holder,$target){
        
        $vote = Vote::where('type','=',$action)
                    ->where('target','=',$target)->first();
        if($action === 'post'){
            $owner = Post::where('p_id','=',$target)->first()->username;
        }elseif($action === 'comment'){
            $owner = Comment::where('id','=',$target)->first()->username;
        }elseif($action === 'reply'){
            $owner = Reply::where('id','=',$target)->first()->username;
        }
        if($vote->up){
            PointsController::decrementPoints($owner,$action);
        }elseif($vote->down){
            PointsController::incremenetPoints($owner,$action);
        }
        $vote->delete();
    }
    
    /**
     * Purge Notification
     * 
     * @param   string  $action
     * @param   string  $holder
     * @param   string  $target
     */
     
    public function purgeNotification($holder,$target){
        return Notification::where('target','=',$target)
                            ->where('action','=',$holder)
                            ->delete();
    }
    
    /**
     * Purge Flagged Reports
     * 
     * @params  string  $type
     * @params  string  $target
     */
    public function purgeReports($type,$target){
        
        return Report::where('type','=',$type)
                    ->where('target','=',$target)
                    ->delete();
    }
    
    /**
     * Purge Post Tags
     * 
     * @param string $holder
     * @param string $target
     */
    public function purgeTags($holder,$target){
        return Tags::where($holder,'=',$target)->delete();
    }
    
    /**
     * Purge Post Categories
     * 
     * @param string $holder
     * @param string $target
     */
    public function purgeCategories($holder,$target){
        return Category::where($holder,'=',$target)->delete();
    }
    
    /**
     * Purge Image File
     */
    public function purgeImage($path){
        File::delete(public_path().$path);
    }
      
    /**
     * Perform Delete Post Operation
     * 
     * @param   string  $post_id
     * @return  bool
     */
    public function purgePost($p_id){
        
        /**
         * Fetch Post Details
         */
        $posts  = Post::where('p_id', '=',$p_id);
        
        $post   = $posts->first();
        
        /**
         * Purge Post Reports
         */
        $this->purgeReports('post',$post->p_id);
        
        /**
         * Post Image URI To Delete
         */
        $this->uri    =   $post->uri;
    
        /**
         * Purge Post Tags
         */
        $this->purgeTags('p_id',$p_id);
        
        /**
         * Purge Post Categories
         */
        $this->purgeCategories('p_id',$p_id);
        
        /**
         * Purge Post Votes
         */
        $this->purgeVotes('post','p_id',$p_id);
        
        /**
         * Fetch Post Comments
         */
        $comments = Comment::where('p_id', '=', $p_id);
        
        foreach($comments->get() as $comment){
            
            /**
             * Fetch Comment Replies
             */
            $replies = Reply::where('comment_id','=',$comment->id); // get comment replies
            
            foreach($replies->get() as $reply){
                
                /**
                 * Purge Reply Votes
                 */
                $this->purgeVotes('reply','reply_id',$reply->id);
                
                /**
                 * Purge Reply Reports
                 */
                $this->purgeReports('reply',$reply->id);
                
                /**
                 * Purge Reply Notification
                 */
                $this->purgeNotification('replylike',$reply->id);
            }
            
            /**
             * Purge Comment Votes
             */
            $this->purgeVotes('comment','comment_id',$comment->id);
            
            /**
             * Purge Comment Reports
             */
            $this->purgeReports('comment',$comment->id);
            
            /**
             * Purge Comment Notifications
             */
            $this->purgeNotification('comment',$comment->p_id);
            
            /**
             * Purge Comment Likes Notification
             */
            $this->purgeNotification('commentlike',$comment->id);
            
            /**
             * Purge Comment Reply Notification
             */
            $this->purgeNotification('commentreply',$comment->id);
            
            /**
             * Purge Reply
             */
            $replies->delete();
        }
        
        /**
         * Purge Image
         */
        $this->purgeImage($this->uri);
        
        /**
         * Purge Notificaion
         */
        Notification::where('target','=',$p_id)->delete();
        
        
        /**
         * Purge Comments & Rosts
         */
        $comments->delete();
        $posts->delete();
        
        return Response::json(array(
            'status'    => true,
        ));
    }

}
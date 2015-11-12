<?php


class notificationController extends BaseController{
    
    public function readNotification(){
        if(Session::has('auth')){
            $action = Input::get('action');
            $target = Input::get('target');
            /*$lang   = Post::where('p_id','=',$target)->first()->language;
            $code   = Language::where('name','=',$lang)->first()->code;*/
            
            if($action === "comment"){
                $read = Notification::where('action_for','=', Session::get('auth')['username'])
                                    ->where('action','=','comment')
                                    ->where('target','=',$target)
                                    ->update(array(
                                        'status' => 0
                                    ));
                
                if($read){
                    $lang   = Post::where('p_id','=',$target)->first()->language;
                    $code   = Language::where('name','=',$lang)->first()->code;
                    return Response::json(array(
                        'status'    => true,
                        'uri'       => URL::secure('/').'/'.$code.'/g/'.$target.'#comments'
                    ));
                    
                }
            }
             if($action === "suggestedpost"){
                $read = Notification::where('action_for','=', Session::get('auth')['username'])
                                    ->where('action','=','suggestedpost')
                                    ->where('target','=',$target)
                                    ->update(array(
                                        'status' => 0
                                    ));
                
                if($read){
                    $lang   = Post::where('p_id','=',$target)->first()->language;
                    $code   = Language::where('name','=',$lang)->first()->code;
                    return Response::json(array(
                        'status'    => true,
                        'uri'       => URL::secure('/').'/'.$code.'/g/'.$target.'#comments'
                    ));
                    
                }
            }
              if($action === "removeprofile"){
                $read = Notification::where('action_for','=', Session::get('auth')['username'])
                                    ->where('action','=','removeprofile')
                                    ->where('target','=',$target)
                                    ->update(array(
                                        'status' => 0
                                    ));
                
                if($read){
                
                    $lang   = User::where('username','=',$target)->first()->language;
                    $code   = Language::where('name','=',$lang)->first()->code;
                    return Response::json(array(
                        'status'    => true,
                        'uri'       => URL::secure('/').'/'.$code.'/g/'.$target.'/settings/profile'
                    ));
                    
                }
            }
            if($action === "commentreply"){
                $read = Notification::where('action_for','=', Session::get('auth')['username'])
                                    ->where('action','=','commentreply')
                                    ->where('target','=',$target)
                                    ->update(array(
                                        'status' => 0
                                    ));
                
                if($read){
                    
                    $p_id = Comment::where('id','=',$target)->first()->p_id;
                    $lang   = Post::where('p_id','=',$p_id)->first()->language;
                    $code   = Language::where('name','=',$lang)->first()->code;
                    
                    return Response::json(array(
                        'status'    => true,
                        'uri'       => URL::secure('/').'/'.$code.'/g/'.$p_id.'#comments'
                    ));
                }
            }
            
            if($action === "postlike"){
                $read = Notification::where('action_for','=', Session::get('auth')['username'])
                                    ->where('action','=','postlike')
                                    ->where('target','=',$target)
                                    ->update(array(
                                        'status' => 0
                                    ));
                if($read){
                    $lang   = Post::where('p_id','=',$target)->first()->language;
                    $code   = Language::where('name','=',$lang)->first()->code;
                    return Response::json(array(
                        'status'    => true,
                        'uri'       => URL::secure('/').'/'.$code.'/g/'.$target
                    ));
                    
                }
            }
            
            if($action === "commentlike"){
                $read = Notification::where('action_for','=', Session::get('auth')['username'])
                                    ->where('action','=','commentlike')
                                    ->where('target','=',$target)
                                    ->update(array(
                                        'status' => 0
                                    ));
                
                if($read){
                    $p_id = Comment::where('id','=',$target)->first()->p_id;
                    $lang   = Post::where('p_id','=',$p_id)->first()->language;
                    $code   = Language::where('name','=',$lang)->first()->code;
                    return Response::json(array(
                        'status'    => true,
                        'uri'       => URL::secure('/').'/'.$code.'/g/'.$p_id.'#comments'
                    ));
                }
            }
            
            if($action === "replylike"){
                $read = Notification::where('action_for','=', Session::get('auth')['username'])
                                    ->where('action','=','replylike')
                                    ->where('target','=',$target)
                                    ->update(array(
                                        'status' => 0
                                    ));
                
                if($read){
                    $c_id = Reply::where('id','=',$target)->first()->comment_id;
                    $url = Comment::where('id','=',$c_id)->first()->p_id;
                    
                    $lang   = Post::where('p_id','=',$url)->first()->language;
                    $code   = Language::where('name','=',$lang)->first()->code;
                    return Response::json(array(
                        'status'    => true,
                        'uri'       => URL::secure('/').'/'.$code.'/g/'.$url.'#comments'
                    ));
                }
            }
        }
    }
    
    public function s_readNotification(){
        $targets    =   Input::get("targets");
        
        for($i = 0; $i<count($targets); $i++){
            Notification::where('id','=',$targets[$i])->update(array(
                'viewed'    => 1
            ));
        }
        
        return Response::json(true);
    }
    
    public function readAllNotification(){
        $targets    =   Input::get("targets");
        
        for($i = 0; $i<count($targets); $i++){
            Notification::where('id','=',$targets[$i])->update(array(
                'status'    => 0
            ));
        }
        
        return Response::json(true);
    }
}

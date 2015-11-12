<?php

class ReportController extends BaseController{
    
    public function report(){
        
        if(Session::has('auth')){
            
            $user   =   Session::get('auth')['username'];
            $type   =   '';
            $id     =   '';
            if(Input::get('type') === "comment"){
                $type   = 'comment';
                $id =   Input::get('cid');
            }
            if(Input::get('type')  === "reply"){
                $type   = "reply";
                $id =   Input::get('rid');
            }
            
            
                
            $dupe   = Report::where('reported_by','=',Session::get('auth')['username'])
                            ->where('target','=',$id)
                            ->where('type', '=',$type)->count();
                
            if(!$dupe){
                $report = new Report;
                $report->reported_by    = $user;
                $report->target         = $id;
                $report->type           = $type;
                    
                if($report->save()){
                    return Response::json(true);
                }else{
                    return Response::json(false);
                }
            }else{
                return Response::json(false);
            }
            
        }
    }
    
    
    public function reportPost(){
        $pid    = Input::get('pid');
        $_reason= Input::get('reason');
        $user   =   Session::get('auth')['username'];
        $type   = 'post';
        $reason = '';
        
        
        if($_reason == 1){
            
            $reason = 'Contains a trademark or copyright violation';
            
        }elseif($_reason == 2){
            
            $reason = 'Spam, blatant advertising, or solicitation';
            
        }elseif($_reason == 3){
            $reason = 'Contains offensive materials/nudity';
        }
         $user_check   = User::where('username',$pid)->count();
       if(isset($user_check) && !empty($user_check))
       {
       $type   = 'user-profile';
       }
        $dupe   = Report::where('reported_by','=',Session::get('auth')['username'])
                        ->where('target','=',$pid)
                        ->where('type', '=',$type)
                        ->where('reason','=',$reason)->count();
       
        
        if(!$dupe){
            $report = new Report;
            $report->reported_by    = $user;
            $report->target         = $pid;
            $report->type           = $type;
            $report->reason         = $reason;
            $report->status         = 0;        
            if($report->save()){
                return Response::json(true);
            }else{
                return Response::json('dupe');
            }
        }else{
            return Response::json(false);
        }
        
    }
}

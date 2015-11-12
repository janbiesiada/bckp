<?php


class PointsController extends BaseController{
    
    /**
     * Check if User Point Records Exist
     * 
     * @params  ($username) User Username
     * @params  ($type)     Typr of Content
     */

    public static function RecordExist($username,$type){
        $check  = Points::where('username','=',$username)
                        ->where('type','=',$type);
        
        return ($check->count()) ? true : false;
    }
    
    /**
     * Create an empty record
     * 
     * @params  ($username)  User Username
     * @params  ($type)     Content Type
     */
     
    public static function createEmptyRecord($username,$type){
        $points             =   new Points;
        $points->username   =   $username;
        $points->type       =   $type;
        $points->points     =   0;
        
        return ($points->save()) ? true: false;
    }
    
    /**
     * Increment Points
     * 
     * @params  ($username)  User Username
     * @params  ($type)     Content Type
     */
    public static function incremenetPoints($username,$type){
        $points         =   Points::where('username','=',$username)
                                ->where('type','=',$type)->first();;
        $points->points +=1;
        
        $points->save();
    }
    
    /**
     * Decrement Points
     * 
     * @params  ($username)  User Username
     * @params  ($type)     Content Type
     */
    public static function decrementPoints($username,$type){
        $points         =   Points::where('username','=',$username)
                                ->where('type','=',$type)->first();
        $points->points -=1;
        
        $points->save();
    }
}
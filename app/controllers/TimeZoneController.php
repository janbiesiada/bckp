<?php


class TimeZoneController extends BaseController{
    
    /**
     * Takes Ajax Request if Client Timezone doesn't match
     * the server default timezone
     */
     
    public function setTimeZone(){
        Session::set('timezone',Input::get('tz'));
        
        if(Session::get('timezone') === Input::get('tz')){
            return Response::json(array(
                'status'    => true,
                'timezone'  => Session::get('timezone')
            ));
        }
    }
    
    /**
     * Calculate Time Elapsed
     * 
     * @params ($eventTime) - Created_at Timestamps
     */
    
    public static function getElapsedTime($eventTime)
    {
       
        date_default_timezone_set(Session::get('timezone'));
        
        $totaldelay = time() - strtotime($eventTime);
        
        if($totaldelay <= 0)
        {
            return $totaldelay .'-> less';
        }
        else
        {
            if($days=floor($totaldelay/86400))
            {
                $totaldelay = $totaldelay % 86400;
                return $days.' days ago.';
            }
            if($hours=floor($totaldelay/3600))
            {
                $totaldelay = $totaldelay % 3600;
                return $hours.' hours ago.';
            }
            if($minutes=floor($totaldelay/60))
            {
                $totaldelay = $totaldelay % 60;
                return $minutes.' minutes ago.';
            }
            if($seconds=floor($totaldelay/1))
            {
                $totaldelay = $totaldelay % 1;
                return $seconds.' seconds ago.';
            }
        }
    }
    
   
}
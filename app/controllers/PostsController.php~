<?php

class PostsController extends BaseController{
    
    /*
    |   Validate and Create new post upload
    */
    
    public function uploadPost(){
        
        /*
        |   Validate File (MAX SIZE, Mime TYPE),
        |   Title and Tags (NOT EMPTY)
        */
        $validator  = Validator::make(Input::all(), array(
            'file'      => 'image|required|max:3000|mimes:jpg,jpeg,gif,png',
            'title'     => 'required|max:120',
            'tags'      => 'required',
            'language'  => 'required'
        ));
        
        /*
        |   if validator fails, create a flash cookie,
        |   return redirct to home, and show file upload form.
        */
        if($validator->fails()){
            return Redirect::secure('/')->withErrors($validator)
                    ->with('uploadfailure', true);
        }else{
            $tags = explode(',',Input::get('tags'));
            for($i= 0; $i<count($tags); $i++){
                $tags[$i] = str_replace("#","",$tags[$i]);
            }
            $tags = array_map('trim', $tags);
            $tags = array_filter($tags);
            
            $categories = [];
            
            if(count($tags) > 3){
                return Redirect::secure('/')->withErrors($validator)
                    ->with('uploadfailure', true)
                    ->with('tagserror','Tags Limit Exceeded!');
            }
            
            
            
            if(Input::has('Meme')){
                array_push($categories,"meme");
            }
            if(Input::has('Cute')){
                array_push($categories,"cute");
            }
            if(Input::has('Comic')){
                array_push($categories,"comic");
            }
            if(Input::has('Cosplay')){
                array_push($categories,"cosplay");
            }
            if(Input::has('Food')){
                array_push($categories,"food");
            }
            if(Input::has('Girl')){
                array_push($categories,"girl");
            }
            if(Input::has('Nsfw')){
                array_push($categories,"nsfw");
            }
            if(Input::has('Wtf')){
                array_push($categories,"wtf");
            }
            if(Input::has('Geeky')){
                array_push($categories,"geeky");
            }
            
            if(count($categories) == 0){
                return Redirect::secure('/')->withErrors($validator)
                    ->with('uploadfailure', true)
                    ->with('postcategorieserror','Please select categories!');
            }
            
            if(count($categories) > 2){
                return Redirect::secure('/')->withErrors($validator)
                    ->with('uploadfailure', true)
                    ->with('postcategorieserror','Categories Limit Exceeded!');
            }
            
            $title  = Input::get('title');
            $id     = str_random(15);
            $stamp  = public_path().'/assets/uploads/watermark.PNG';
            $lang   = Input::get('language');
            $uri    = '';
            $source = 'user';
            $ext    = Input::file('file')->getClientOriginalExtension();
            $type   = '';
            if(!File::exists(public_path().'/uploads/gags/')) {
                File::makeDirectory(public_path().'/uploads/gags/');
            }
            
            if(strtolower($ext) === "jpg" || strtolower($ext) === "jpeg" || strtolower($ext) === "png"){
                $uri = '/uploads/gags/'.$id.'.'.$ext;
                $img = Image::make(Input::file('file'));
              //  $img->insert($stamp,'bottom-right', 10, 50);
                $img->save(public_path().$uri);
                 $type = "photo";
            }else if(strtolower($ext) === "gif"){
                $type = "gif";
                $uri = '/uploads/gags/'.$id.'.'.$ext;
                Input::file('file')->move(public_path().'/uploads/gags/',$id.'.'.$ext);
            }
            
            $new_post   = Post::create(array(
                'p_id'      => $id,
                'username'  => Session::get('auth')['username'],
                'title'     => $title,
                'uri'       => $uri,
                'source'    => $source,
                'points'    => 0,
                'status'    => 0,
                'language'  => $lang,
                'type'      => $type
            ));
            
            if($new_post){
                for($i= 0; $i<count($tags); $i++){
                    $new_tags   = Tags::create(array(
                        'p_id'      =>  $id,
                        'tags'      =>  $tags[$i],
                        'language'  =>  $lang,
                        'type'      => 'p'
                    ));
                }
                for($i= 0; $i<count($categories); $i++){
                    $categories   = Category::create(array(
                        'p_id'  => $id,
                        'category'  => $categories[$i]
                    ));
                }
                return Redirect::secure('/')->with('global','Post successfully submitted');
            }else{
                return Redirect::secure('/')->with('global','Error : Unable to create post');
            }
        }
    }
    
    /*
    |   Validate and Create new URL post upload
    */
    
    public function urlUploadPost(){
        $validator  = Validator::make(Input::all(), array(
            'url'       => 'required',
            'title'     => 'required|max:120',
            'tags'      => 'required',
            'language'  => 'required'
        ));
       
        if($validator->fails()){
            return Redirect::secure('/')->withErrors($validator)
                    ->with('url-uploadfailure', true);
        }else{
            
            $tags = explode(',',Input::get('tags'));
            for($i= 0; $i<count($tags); $i++){
                $tags[$i] = str_replace("#","",$tags[$i]);
            }
            $tags = array_map('trim', $tags);
            $tags = array_filter($tags);
            
            $categories = [];
            
            if(count($tags) > 3){
                return Redirect::secure('/')->withErrors($validator)
                    ->with('url-uploadfailure', true)
                    ->with('tagserror','Tags Limit Exceeded!');
            }
            
            if(Input::has('Meme')){
                array_push($categories,"meme");
            }
            if(Input::has('Cute')){
                array_push($categories,"cute");
            }
            if(Input::has('Comic')){
                array_push($categories,"comic");
            }
            if(Input::has('Cosplay')){
                array_push($categories,"cosplay");
            }
            if(Input::has('Food')){
                array_push($categories,"food");
            }
            if(Input::has('Girl')){
                array_push($categories,"girl");
            }
            if(Input::has('Nsfw')){
            array_push($categories,"nsfw");
            }
            if(Input::has('Wtf')){
                array_push($categories,"wtf");
            }
            if(Input::has('Geeky')){
                array_push($categories,"geeky");
            }
            
            if(count($categories) == 0){
                return Redirect::secure('/')->withErrors($validator)
                    ->with('url-uploadfailure', true)
                    ->with('postcategorieserror','Please select categories!');
            }
            
            if(count($categories) > 2){
                return Redirect::secure('/')->withErrors($validator)
                    ->with('url-uploadfailure', true)
                    ->with('postcategorieserror','Categories Limit Exceeded!');
            }
            
            
            $title  = Input::get('title');
            $id     = str_random(15);
            $stamp  = public_path().'/assets/uploads/watermark.PNG';
            $lang   = Input::get('language');
            $uri    = '';
            $ext    = '';
            $type   = '';
            $source = 'remote';
            
            if(!File::exists(public_path().'/uploads/gags/')) {
                File::makeDirectory(public_path().'/uploads/gags/');
            }
            
            
            $url    = Input::get('url');
            $verify = PostsController::isImage($url);
            if(!$verify){
               return Redirect::secure('/')->withErrors($validator)
                    ->with('url-uploadfailure', true)
                    ->with('invalidurl','Invalid Image URL');
            }else{
                if($verify['mime'] === "image/jpeg" || $verify['mime'] === "image/jpg" || $verify['mime'] === "image/png" || $verify['mime'] === "image/gif"){
                    if($verify['mime'] === "image/jpeg"){
                        $ext = "jpg";
                        
                    }
                    if($verify['mime'] === "image/jpg"){
                        $ext = "jpg";
                       
                    }
                    if($verify['mime'] === "image/png"){
                        $ext = "png";
                       
                    }
                    if($verify['mime'] === "image/gif"){
                        $ext = "gif";
                        
                    }
                }else{
                    return Redirect::secure('/')->withErrors($validator)
                    ->with('url-uploadfailure', true)
                    ->with('invalidurl','Invalid Image Extension : only jpg,jpeg,gif,png allowed');
                }
            }
            
            if(strtolower($ext) === "jpg" || strtolower($ext) === "jpeg" || strtolower($ext) === "png"){
                $type   = 'photo';
                $img = Image::make($url); 
                //$img->insert($stamp,'bottom-right', 10, 50);
                $img->save(public_path().'/uploads/gags/'.$id.'.'.$ext,50);
                $uri = '/uploads/gags/'.$id.'.'.$ext;
                 
            }else if(strtolower($ext) === "gif"){
                $type   = 'gif';
                $uri = '/uploads/gags/'.$id.'.'.$ext;
                file_put_contents(public_path().$uri, file_get_contents($url));
            }
            
            $new_post   = Post::create(array(
                'p_id'      => $id,
                'username'  => Session::get('auth')['username'],
                'title'     => $title,
                'uri'       => $uri,
                'source'    => $source,
                'points'    => 0,
                'status'    => 0,
                'language'  => $lang,
                'type'      => $type
            ));
            
            if($new_post){
                for($i= 0; $i<count($tags); $i++){
                    $new_tags   = Tags::create(array(
                        'p_id'  => $id,
                        'tags'  => $tags[$i],
                        'language'  => $lang,
                        'type'      => 'p'
                    ));
                }
                for($i= 0; $i<count($categories); $i++){
                    $categories   = Category::create(array(
                        'p_id'      => $id,
                        'category'  => $categories[$i]
                    ));
                }
                return Redirect::secure('/')->with('global','Post successfully submitted');
            }else{
                return Redirect::secure('/')->with('global','Error : Unable to create post');
            }
        }
    }
    
    function vinesUpload(){
        $validator  = Validator::make(Input::all(), array(
            'url'       => 'required',
            'title'     => 'required|max:120',
            'tags'      => 'required',
            'language'  => 'required'
        ));
        
        if($validator->fails()){
            return Redirect::secure('/')->withErrors($validator)
                    ->with('vine-uploadfailure', true);
        }else{
            
            $tags = explode(',',Input::get('tags'));
            for($i= 0; $i<count($tags); $i++){
                $tags[$i] = str_replace("#","",$tags[$i]);
            }
            $tags = array_map('trim', $tags);
            $tags = array_filter($tags);
            
            $categories = [];
            
            if(count($tags) > 3){
                return Redirect::secure('/')->withErrors($validator)
                    ->with('vine-uploadfailure', true)
                    ->with('tagserror','Tags Limit Exceeded!');
            }
            
            if(Input::has('Meme')){
                array_push($categories,"meme");
            }
            if(Input::has('Cute')){
                array_push($categories,"cute");
            }
            if(Input::has('Comic')){
                array_push($categories,"comic");
            }
            if(Input::has('Cosplay')){
                array_push($categories,"cosplay");
            }
            if(Input::has('Food')){
                array_push($categories,"food");
            }
            if(Input::has('Girl')){
                array_push($categories,"girl");
            }
            if(Input::has('Nsfw')){
                array_push($categories,"nsfw");
            }
            if(Input::has('Wtf')){
                array_push($categories,"wtf");
            }
            if(Input::has('Geeky')){
                array_push($categories,"geeky");
            }
            
            if(count($categories) == 0){
                return Redirect::secure('/')->withErrors($validator)
                    ->with('vine-uploadfailure', true)
                    ->with('postcategorieserror','Please select categories!');
            }
            
            if(count($categories) > 2){
                return Redirect::secure('/')->withErrors($validator)
                    ->with('vine-uploadfailure', true)
                    ->with('postcategorieserror','Categories Limit Exceeded!');
            }
            $title  = Input::get('title');
            $id     = str_random(15);
            $lang   = Input::get('language');
            $url    = Input::get('url');
            $str_url=explode('/',$url);
            $type   = 'video';
            $source = 'vine';
            if (in_array("http:",  $str_url)) {
                   }elseif(in_array("https:",  $str_url)){
                   }else{
                   return Redirect::secure('/')->withErrors($validator)
                    ->with('vine-uploadfailure', true)
                    ->with('invalidurl',"Invalid URL, doesn't exist!");
                   }
            $url_exist_check = get_headers($url);
            $header_check = $url_exist_check[0];
            if(!strpos($header_check,"200")){
                return Redirect::secure('/')->withErrors($validator)
                    ->with('vine-uploadfailure', true)
                    ->with('invalidurl',"Invalid URL, doesn't exist!");
            }
            $vineURL = 'https://vine.co/v/';
            $tr_url=trim($url);
            /*not validating no vine-videos */
             $pos = stripos($url, $vineURL);
             if ($pos !== 0) {
                    return Redirect::secure('/')->withErrors($validator)
                    ->with('vine-uploadfailure', true)
                    ->with('invalidurl',"Only Vine video URL allowed");
            }
            $new_post   = Post::create(array(
                'p_id'      => $id,
                'username'  => Session::get('auth')['username'],
                'title'     => $title,
                'uri'       => $url,
                'source'    => $source,
                'points'    => 0,
                'status'    => 0,
                'language'  => $lang,
                'type'      => $type
            ));
            
            if($new_post){
                for($i= 0; $i<count($tags); $i++){
                    $new_tags   = Tags::create(array(
                        'p_id'  => $id,
                        'tags'  => $tags[$i],
                        'language'  => $lang,
                        'type'      => 'p'
                    ));
                }
                for($i= 0; $i<count($categories); $i++){
                    $categories   = Category::create(array(
                        'p_id'      => $id,
                        'category'  => $categories[$i]
                    ));
                }
                return Redirect::secure('/')->with('global','Post successfully submitted');
            }else{
                return Redirect::secure('/')->with('global','Error : Unable to create post');
            }
        }
    }
    
    
    function youtubeUpload(){
        $validator  = Validator::make(Input::all(), array(
            'url'       => 'required',
            'title'     => 'required|max:120',
            'tags'      => 'required',
            'language'  => 'required'
        ));
        
        if($validator->fails()){
            return Redirect::secure('/')->withErrors($validator)
                    ->with('youtube-uploadfailure', true);
        }else{
            
            $tags = explode(',',Input::get('tags'));
            for($i= 0; $i<count($tags); $i++){
                $tags[$i] = str_replace("#","",$tags[$i]);
            }
            $tags = array_map('trim', $tags);
            $tags = array_filter($tags);
            
            $categories = [];
            
            if(count($tags) > 3){
                return Redirect::secure('/')->withErrors($validator)
                    ->with('youtube-uploadfailure', true)
                    ->with('tagserror','Tags Limit Exceeded!');
            }
            
            if(Input::has('Meme')){
                array_push($categories,"meme");
            }
            if(Input::has('Cute')){
                array_push($categories,"cute");
            }
            if(Input::has('Comic')){
                array_push($categories,"comic");
            }
            if(Input::has('Cosplay')){
                array_push($categories,"cosplay");
            }
            if(Input::has('Food')){
                array_push($categories,"food");
            }
            if(Input::has('Girl')){
                array_push($categories,"girl");
            }
            if(Input::has('NSFW')){
                array_push($categories,"nsfw");
            }
            if(Input::has('WTF')){
                array_push($categories,"wtf");
            }
            if(Input::has('Geeky')){
                array_push($categories,"geeky");
            }
            
            if(count($categories) == 0){
                return Redirect::secure('/')->withErrors($validator)
                    ->with('youtube-uploadfailure', true)
                    ->with('postcategorieserror','Please select categories!');
            }
            
            if(count($categories) > 2){
                return Redirect::secure('/')->withErrors($validator)
                    ->with('youtube-uploadfailure', true)
                    ->with('postcategorieserror','Categories Limit Exceeded!');
            }
            $title  = Input::get('title');
            $id     = str_random(15);
            $lang   = Input::get('language');
            $url    = Input::get('url');
            $str_url=explode('/',$url);
            $type   = 'video';
            $source = 'youtube';
            if (in_array("http:",  $str_url)) {
                   }elseif(in_array("https:",  $str_url)){
                   }else{
                   return Redirect::secure('/')->withErrors($validator)
                    ->with('youtube-uploadfailure', true)
                    ->with('invalidurl',"Invalid URL, doesn't exist!");
                   }
            $url_exist_check = get_headers($url);
            $header_check = $url_exist_check[0];
            if(!strpos($header_check,"200")){
                return Redirect::secure('/')->withErrors($validator)
                    ->with('youtube-uploadfailure', true)
                    ->with('invalidurl',"Invalid URL, doesn't exist!");
            }
            
            parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
             if(isset($my_array_of_vars['v']) && !empty($my_array_of_vars['v'])){
            if (!$this->yt_exists($my_array_of_vars['v'])) {
                return Redirect::secure('/')->withErrors($validator)
                    ->with('youtube-uploadfailure', true)
                    ->with('invalidurl',"Invalid YouTube Video URL.");
            }}else{
            return Redirect::secure('/')->withErrors($validator)
                    ->with('youtube-uploadfailure', true)
                    ->with('invalidurl',"Only YouTube Video URL allowed.");
            }
            $url = "https://www.youtube.com/embed/".$my_array_of_vars['v'];
            $new_post   = Post::create(array(
                'p_id'      => $id,
                'username'  => Session::get('auth')['username'],
                'title'     => $title,
                'uri'       => $url,
                'source'    => $source,
                'points'    => 0,
                'status'    => 0,
                'language'  => $lang,
                'type'      => $type
            ));
            
            if($new_post){
                for($i= 0; $i<count($tags); $i++){
                    $new_tags   = Tags::create(array(
                        'p_id'  => $id,
                        'tags'  => $tags[$i],
                        'language'  => $lang,
                        'type'      => 'p'
                    ));
                }
                for($i= 0; $i<count($categories); $i++){
                    $categories   = Category::create(array(
                        'p_id'      => $id,
                        'category'  => $categories[$i]
                    ));
                }
                return Redirect::secure('/')->with('global','Post successfully submitted');
            }else{
                return Redirect::secure('/')->with('global','Error : Unable to create post');
            }
        }
    }
    
    function yt_exists($videoID) {
        $theURL = "http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=$videoID&format=json";
        $headers = get_headers($theURL);
    
        if (substr($headers[0], 9, 3) !== "404") {
            return true;
        } else {
            return false;
        }
    }
 
    function isImage($url)
    {
        $getimage = @getimagesize($url);
        if($getimage){
            return $getimage;
        }else{
            return false;
        }
    }
    
    public function addTag(){
        $tag    =   Input::get('tag');
        $user   =   Session::get('auth')['username'];
        $p_id   =   Input::get('post_id');
        $owner  =   Post::where('p_id','=',$p_id)->first()->username;
        
        $search =   Tags::where('tags','=',$tag)
                        ->where('p_id','=',$p_id)
                        ->count();
        
        if($search){
            return Response::json(array('status' => 'exist'));
        }else{
            $search =   TagSuggests::where('tags','=',$tag)
                                    ->where('p_id','=',$p_id)
                                    ->where('username','=',$user)
                                    ->count();
            if($search){
                return Response::json(array('status' => 'exist'));
            }else{
                
                $search =   TagSuggests::where('p_id','=',$p_id)
                                    ->where('username','=',$user)
                                    ->count();
                if($search > 2){
                    return Response::json(array('status' => 'full'));
                }else{
                    $add =  TagSuggests::create(array(
                                'p_id'      =>  $p_id,
                                'tags'      =>  $tag,
                                'username'  =>  $user,
                                'owner'     =>  $owner
                            ));
                    if($add){
                        return Response::json(array('status' => 'added'));
                    }
                }
            }
        }
    }
}

<?php

class AdminController extends BaseController{
    
    /**
     * Authenticated Administration Panel View
     */
    public function index(){
        return View::make('admin.authenticated.dashboardview');
    }

    /**
     * Generate Admin Registration Form (View)
     */
    public function registerGet(){
        return View::make('admin.register');
    }
    
    /**
     * Generate Admin Authentication Login Form (View)
     */
    public function loginGet(){
        return View::make('admin.login');
    }
    
    /**
     * Analytics Dashboard
     */
    public function analytics(){
        return View::make('admin.authenticated.reports.ga_analytics');
    }
    
    /**
     * Admin Registration (POST)
     */
    public function Register(){
        
        $validator = Validator::make(Input::all(), array(
            'name'          => 'required',
            'username'      => 'required|min:3|max:30|unique:admins',
            'email'         => 'required|email|unique:admins',
            'password'      => 'required|min:6'
        ));
        
        if($validator->fails()){
            return Redirect::secure('/9gag-admin/register')->withErrors($validator)->withInput();
        }else{
            
            $type       = (Admin::count() > 0) ? 'staff' : 'owner';
            $approved   = (Admin::count() > 0) ? 0 : 1;
            $code       = str_random(60);
            $email      = Input::get('email');
            $username   = Input::get('username');
            $new = Admin::create(array(
                'name'              => Input::get('name'),
                'username'          => $username,
                'password'          => Hash::make(Input::get('password')),
                'email'             => $email,
                'active'            => 0,
                'approved'          => $approved,
                'dp_uri'            => URL::secure('/assets/uploads').'/avatar-st.png',
                'type'              => $type,
                'activate_code'     => $code
            ));
            
            if($new){
                Mail::send('admin.emails.auth.activate', array(
					'link' => URL::route('admin-account-activate', $code) ,
					'username' => $username
				),
                           
				function ($message) use($username,$email){
					$message->to($email, 
                    $username)->subject('Activate your Account');
				});
				
                return Redirect::secure('/9gag-admin/login')->with('global','Please verify account, check your email for link!');
            }else{
                return Redirect::secure('/9gag-admin/login')->with('global','Unable to create your account, Try again!!');
            }
        }
    }
    
    /**
     * User Authentication Login From (POST)
     */
    public function Login(){
        
        $validator = Validator::make(Input::all(),array(
            'email'     => 'required|email',
            'password'  => 'required'
        ));
        
        if($validator->fails()){
            return Redirect::secure('/9gag-admin/login')->withErrors($validator)->withInput();
        }else{
            $admin =  Admin::where('email','=',Input::get('email'));
            
            if($admin->count()){
                $admin = $admin->first();
                
                if(Hash::check(Input::get('password'), $admin->password)){
                    if($admin->type === "owner"){
                        if($admin->active == 0){
                            return Redirect::secure('/9gag-admin/login')
                            ->with('global', 'Verify Account! Check your email for verification link!');
                        }else{
                            $session = array(
                                'username'  =>  $admin->username,
                                'name'      =>  $admin->name,
                                'email'     =>  $admin->email,
                                'gender'    =>  $admin->gender,
                                'dp_uri'    =>  $admin->dp_uri,
                                'type'      =>  $admin->type,
                                'created_at'=>  $admin->created_at
                            );
                            Session::put('admin_auth',$session);
                            return Redirect::secure('/9gag-admin');
                        }
                    }
                    else if($admin->type === "staff"){
                        if($admin->active == 0){
                            return Redirect::secure('/9gag-admin/login')
                            ->with('global', 'Verify Account! Check your email for verification link!');
                        }else{
                            if($admin->approved == 1){
                                $session = array(
                                    'username'  =>  $admin->username,
                                    'name'      =>  $admin->name,
                                    'email'     =>  $admin->email,
                                    'gender'    =>  $admin->gender,
                                    'dp_uri'    =>  $admin->dp_uri,
                                    'type'      =>  $admin->type,
                                    'created_at'=>  $admin->created_at
                                );
                                Session::put('admin_auth',$session);
                                return Redirect::secure('/9gag-admin');
                            }else{
                                return Redirect::secure('/9gag-admin/login')
                                    ->with('global', 'your accounts needs approval from administrator!');
                            }
                        }
                    }
                    
                    
                }else{
                    return Redirect::secure('/9gag-admin/login')
                        ->with('global', 'Incorrect Login Credentials!');
                }
            }else{
                return Redirect::secure('/9gag-admin/login')
                        ->with('global', 'Incorrect Login Credentials!');
            }
        }
    }
    
    /**
     * Verify Admin with Email Code
     */
    public function getActivate($code){
        $user = Admin::where('activate_code', '=', $code)->where('active', '=', 0);
		if ($user->count()){
			$user = $user->first();

			$user->active = 1;
			$user->activate_code = '';
			
			if ($user->save()){
			    return Redirect::secure('9gag-admin/login')->with('global', 'Congrats! We have activated your account');
            }
            
        }
        
        return Redirect::secure('/9gag-admin/login')
                ->with('global', 'we could not activate your account, 
                 try again late!');
        
        die();
    }
    
    /**
     * Logout Authenticated Administrator
     */
    public function logout(){
        Session::forget('admin_auth');
        return Redirect::secure('/9gag-admin/login');
    }
    
    
    /**
     * Manage Registered Admins
     */
    public function manageAdmins(){
        if (Request::isMethod('get'))
        {
            $admins = Admin::all();
            return View::make('admin.authenticated.manageadmins')->with('admins',$admins);
        }
        
        if (Request::isMethod('post'))
        {
            if(Session::get('admin_auth')['type'] === "owner"){
                $action = Input::get('action');
                $admin  = Input::get('admin');
                
                if($action === "approve"){
                    $user =     Admin::where('username', '=', $admin)->update(array(
                                    'approved'  => 1
                                ));
                                
                    if($user){
                        return Response::json(true);
                    }
                }
                
                if($action === "remove"){
                    $user   = Admin::where('username','=',$admin)->delete();
                    
                    return Response::json(true);
                }
                
                if($action === "revoke"){
                    $user   =   Admin::where('username','=',$admin)->update(array(
                                    'approved'  =>  0
                                ));
                    if($user){
                        return Response::json(true);
                    }
                }
            }
        }
    }
    
    /**
     * Submissions Waiting for Approval
     */
    public function approvePosts(){
        if (Request::isMethod('get'))
        {
            $posts  =   Post::where('status', '=', 0)->paginate(5);
        
            return View::make('admin.authenticated.approve_posts')->with('posts',$posts);
        }
        
        if (Request::isMethod('post'))
        {
            if(Session::has('admin_auth')){
                $pid    =   Input::get('pid');
                
                $post   =   Post::where('p_id','=',$pid)->update(array(
                                'status'    => 1
                            ));
                if($post){
                    return Response::json(true);
                }
            }
        }
    }
    
    /**
     * Registered User Account Details
     */
    public function userDetails(){
        if (Request::isMethod('get'))
        {
            return View::make('admin.authenticated.manage.details');
        }
        
        if (Request::isMethod('post'))
        {
            $found      =   false;
            if(Session::has('admin_auth')){
                $username   =   Input::get('username');
                $user   =   User::where('username','=', $username);
                
                if($user->count()){
                    $found      = true;
                    $user       = $user->first();
                    $date       = date("Y-m-d", strtotime($user->created_at));
                    $p_count    = Post::where('username','=',$username)->count();
                    $c_count    = Comment::where('username','=',$username)->count() + Reply::where('username','=',$username)->count();
                    
                    return Response::json(array(
                        'exist'     => $found,
                        'user'      => $user,
                        'p_count'   => $p_count,
                        'c_count'   => $c_count,
                        'date'      => $date
                    ));
                }else{
                    return Response::json(array(
                        'exist'     => $found
                    ));
                }
            }
        }
    }
    
    /**
     * Delete Registered User
     */
    public function deleteUser(){
        if (Request::isMethod('get'))
        {
            return View::make('admin.authenticated.manage.delete');
        }
        
        if (Request::isMethod('post'))
        {
            $username   =   Input::get('username');
            $user   =   User::where('username','=', $username)->first();
            
            $this->clearUserRecords($username);
            if($user->delete()){
                return Response::json(true);
            }
            return Response::json(true);
        }
    } 
    
    /**
     * Ban Registered User
     */
    public function banUser(){
        $username   =   Input::get('username');
        $user   =   User::where('username','=', $username)->first();
        
        $user->ban  =   1;
        
        if($user->save()){
            return Response::json(true);
        }
        
    }
    
    /**
     * UnBan Registered User
     */
    public function unBanUser(){
        $username   =   Input::get('username');
        $user   =   User::where('username','=', $username)->first();
        
        $user->ban  =   0;
        
        if($user->save()){
            return Response::json(true);
        }
    }
    
    
    /**
     * Registered Users List
     */
    public function usersList(){
        if (Request::isMethod('get'))
        {
            $users  = User::where('active','=',0)->orWhere('active','=',1)->orderBy('username','ASC')->paginate(50);
                
            return View::make('admin.authenticated.manage.users')
                        ->with('users',$users);
        }
    }
    
    /**
     * Newsletter Subscriptions
     */
    public function subscriptions(){
        if (Request::isMethod('get'))
        {
            $users  = Subscribe::where('verified','=',0)->orWhere('verified','=',1)->orderBy('email','DESC')->paginate(50);
            
        
            return View::make('admin.authenticated.manage.subscriptions')
                        ->with('users',$users);
        }
        if (Request::isMethod('post')){
            $remove =   Subscribe::where('id','=',Input::get('sub_id'))->delete();
            if($remove){
                return Response::json(true);
            }else{
                return Response::json(false);
            }
        }
        
    }
    
    
    /**
     * Flagged Posts
     */
    public function flaggedPost(){
        if (Request::isMethod('get'))
        {
            
            $reports = Report::where('type','=','post')->orderBy('created_at','DESC')->paginate(10);
           
            $posts   = [];
            $i  = 0;
            foreach($reports as $report){
                $data = Post::where('p_id',$report->target)->first();
                 
                $data->reported_by  =   $report->reported_by;
                $data->reason       =   $report->reason;
                $data->reportid     =   $report->id;
                array_push($posts,$data);
            }
        
            return View::make('admin.authenticated.flaggedcontent.posts')
                        ->with('posts',$posts)
                        ->with('report',$reports);
        }
        
        if (Request::isMethod('post'))
        {
            $rid    =   Input::get('rid');
            $pid    =   Input::get('pid');
            if(Input::get('action') === "remove"){
                
                $this->removePost($pid);
                
                $this->cancelFlag($rid,'post',$pid);
                return Response::json(array('status' => true,'action' => 'remove'));
                
            }else if(Input::get('action') === "cancel"){
                $this->cancelFlag($rid,'post',$pid);
                return Response::json(array('status' => true,'action' => 'cancel'));
                
            }
        }
    }
    public function flaggedTags(){
        if (Request::isMethod('get'))
        {
            
            $hidden_tags = Hide::orderBy('created_at','DESC')->paginate(10);
            $posts   = [];
            $i  = 0;
            foreach($hidden_tags as $hidden){
                $data = Hide::where('reason',$hidden->reason)->first();
                $data->username     =   $hidden->username;
                $data->reason       =   $hidden->reason;
                $data->reort_tag_id     = $hidden->id;
                array_push($posts,$data);
            }
        
            return View::make('admin.authenticated.flaggedcontent.tags')
                        ->with('posts',$posts)
                        ->with('report', $hidden_tags );
        }
        
        if (Request::isMethod('post'))
        {
            $rid    =   Input::get('rid');
            $pid    =   Input::get('pid');
            if(Input::get('action') === "remove"){
                
                $this->removePost($pid);
                
                $this->cancelFlag($rid,'post',$pid);
                return Response::json(array('status' => true,'action' => 'remove'));
                
            }else if(Input::get('action') === "cancel"){
                $this->cancelFlag($rid,'post',$pid);
                return Response::json(array('status' => true,'action' => 'cancel'));
                
            }
        }
    }
    
    /**
     * Flagged Comments
     */
    public function flaggedComments(){
        if (Request::isMethod('get'))
        {
            
            $reports = Report::where('type','=','comment')->orderBy('created_at','DESC')->paginate(10);
            $comments   = [];
            $i  = 0;
            foreach($reports as $report){
                $data = Comment::where('id',$report->target)->first();
                $data->reported_by  =   $report->reported_by;
                $data->reason       =   $report->reason;
                $data->reportid     =   $report->id;
                array_push($comments,$data);
            }
            
            
            return View::make('admin.authenticated.flaggedcontent.comments')->with('comments',$comments)->with('report',$reports);
        }
        
        if (Request::isMethod('post'))
        {
            $rid    =   Input::get('rid');
            $cid    =   Input::get('cid');
            if(Input::get('action') === "remove"){
                
                $this->removeComment($cid);
                $this->cancelFlag($rid,'comment',$cid);
                return Response::json(array('status' => true,'action' => 'remove'));
                
            }else if(Input::get('action') === "cancel"){
                
                $this->cancelFlag($rid,'comment',$cid);
                return Response::json(array('status' => true,'action' => 'cancel'));
            }
        }
    }
    
    /**
     * Flagged Replies
     */
    public function flaggedReplies(){
        if (Request::isMethod('get'))
        {
            
            $reports = Report::where('type','=','reply')->orderBy('created_at','DESC')->paginate(10);
            $replies   = [];
            $i  = 0;
            foreach($reports as $report){
                $data = Reply::where('id',$report->target)->first();
                $data->reported_by  =   $report->reported_by;
                $data->reason       =   $report->reason;
                $data->reportid     =   $report->id;
                array_push($replies,$data);
            }
            return View::make('admin.authenticated.flaggedcontent.replies')->with('replies',$replies)->with('report',$reports);
        }
        
        if (Request::isMethod('post'))
        {   
            
            $rid    =   Input::get('rid');
            $cid    =   Input::get('cid');
            if(Input::get('action') === "remove"){
                
                $this->removeReply($cid);
                $this->cancelFlag($rid,'reply',$cid);
                return Response::json(array('status' => true,'action' => 'remove'));
              
            
            }else if(Input::get('action') === "cancel"){
                
                $this->cancelFlag($rid,'reply',$cid);
                return Response::json(array('status' => true,'action' => 'cancel'));
                
            }
        }
    }
    
    /**
     * Remove Flag Report
     * 
     * @param   string $rid     (ReportID)
     * @param   string $type    (Reported Content Type)
     * @param   string $target  (Report COntent Unique ID)
     */
    public function cancelFlag($rid,$type,$target){
        Report::where('id','=',$rid)
                ->where('type','=',$type)
                ->where('target',$target)
                ->delete();
    }
     /**
     * Flag Profile
     * 
     * @param   string $rid     (ReportID)
     * @param   string $type    (Reported Content Type)
     * @param   string $target  (Report COntent Unique ID)
     */
    public function removeProfile(){
        if (Request::isMethod('get'))
        {
            
            $reports = Report::where('type','=','user-profile')->orderBy('created_at','DESC')->paginate(10);
            $comments   = [];
            $i  = 0;
            foreach($reports as $report){
                $data = User::where('username',$report->target)->first();
                $data->reported_by  =   $report->reported_by;
                $data->reason       =   'Inappropriate Profile Picture.';
                $data->reportid     =   $report->id;
                $data->target     =     $report->target;
                $data->updated_at     =   $report->updated_at;
                array_push($comments,$data);
            }
            
            
            return View::make('admin.authenticated.flaggedcontent.report-profile')->with('posts',$comments)->with('report',$reports);
        }
    }
    
      
    /**
     * Remove Flag Picture
     * 
     * @param   string $rid     (ReportID)
     * @param   string $type    (Reported Content Type)
     * @param   string $target  (Report COntent Unique ID)
     */
    public function removePicture(){
  //  echo '<pre>';print_r($_POST);exit;
    $no_image= URL::secure('/assets/uploads').'/no_image.jpeg';
    $target_user=Input::get('target');
     $reported_by_user=Input::get('reported_by');
     $suus=   User::where('users.username',Input::get('target'))
               ->update(array('dp_uri' => $no_image));
               if($suus){
               
                $su=  Report::where('reported_by',Input::get('reported_by'))
                ->where('target',Input::get('target'))
                ->where('type','user-profile')
               ->update(array('status' => 1));
               }
              $notify=Notify::removePic($target_user, $reported_by_user);
               return Redirect::secure('/9gag-admin')->with('successfully removed.');
    }
    
    /**
     * Remove Reply
     * 
     * @param   string  $replyid    (Unique Reply ID)
     */
    public function removeReply($replyid){
        
        $purge     =   new DeleteController();
        
        $purge->purgeReply($replyid);
    }
    
    /**
     * Remove Comment
     * 
     * @param   string  $cid    (Unqiue Comment ID)
     */
    public function removeComment($c_id){
        
        $purge     =   new DeleteController();
        
        $purge->purgeComment($c_id);
        
    }
    
    /**
     * Remove Post
     * 
     * @param   string  $pid    (Unique Post ID)
     */
    public function removePost($pid){
        
        $purge     =   new DeleteController();
        $purge->purgePost($pid);
    }
    
    /**
     * Clear User Content
     * 
     * @params string $username
     */
    public function clearUserRecords($username){
        $this->removeUserVotes($username);
        $this->removeUserContent($username);
        $this->removeUserComments($username);
        $this->removeUserReplies($username);
        $this->removeUserReports($username);
        $this->removeUserNotification($username);
        $this->removeProfileVisuals($username);
    }
    
    /**
     * Clear User Comments
     * 
     * @params string $username
     */
    public function removeUserComments($username){
        Comment::where('username','=',$username)->delete();
    }
    
    /**
     * Clear user Replies
     * 
     * @params string $username
     */
    public function removeUserReplies($username){
        Reply::where('username','=',$username)->delete();
    }
    
    /**
     * Remove User Votes
     *
     * @params string $username
     */
    public function removeUserVotes($username){
        
        /**
         * 
         * TODO (RE_COUNT USER VOTES) 
         * 
         */
        
        $votes  =   Vote::where('username','=',$username)->get();
    
        foreach($votes as $vote){
            if($vote->type === "post"){
                if($vote->up == 1){
                    Post::where('p_id','=',$vote->target)->decrement('points');
                }
                
                if($vote->down == 1){
                    Post::where('p_id','=',$vote->target)->increment('points');
                }
            }
            
            if($vote->type === "comment"){
                if($vote->up == 1){
                    Comment::where('id','=',$vote->target)->decrement('points');
                }
                
                if($vote->down == 1){
                    Comment::where('id','=',$vote->target)->increment('points');
                }
            }
            
            if($vote->type === "reply"){
                if($vote->up == 1){
                    Reply::where('id','=',$vote->target)->decrement('points');
                }
                
                if($vote->down == 1){
                    Reply::where('id','=',$vote->target)->increment('points');
                }
            }
        } 
        Vote::where('username','=',$username)->delete();
    }
    
    /**
     * Remove User Reports
     * 
     * @params string $username
     */
    public function removeUserReports($username){
        Report::where('reported_by','=',$username)->delete();
    }
    
    /**
     * Remove User Notifications
     * 
     * @params string $username
     */
    public function removeUserNotification($username){
        Notification::where('action_by','=',$username)
                    ->orWhere('action_for','=',$username)
                    ->delete();
    }
    /**
     * Remove User Profile Picture & Cover photos
     */
    
    public function removeProfileVisuals($username){
        File::deleteDirectory(public_path().'/uploads/covers/'.$username);
        File::deleteDirectory(public_path().'/uploads/profile/'.$username);
    }
    
    /**
     * Remove User Content
     * 
     * @param   string $username
     */
    public static function removeUserContent($username){
        
        $posts = Post::where('username','=',$username)->get();
        
        foreach($posts as $post){
            $purge     =   new DeleteController();
            $purge->purgePost($post->p_id);
        }
    }
    
    /**
     * Privacy Policy Editor
     */
    public function policy(){
        if(Request::isMethod("get")){
            return View::make('admin.authenticated.manage.privacy_policy');
        }
        
        if(Request::isMethod('post')){
            $policy =   Input::get('policy');
            
            $update =   MetaData::where('type','=','details')->update(array(
                            'privacypolicy' => $policy
                        ));
            if($update){
                return Redirect::secure('/9gag-admin/editor/policy')->with('policyupdate',"Privacy Policy Updated");
            }
        }
    }
    
    /**
     * Languages Management
     */
    public function languages(){
        if(Request::isMethod("get")){
            $language   =   Language::all();
            return View::make('admin.authenticated.manage.languages')->with('languages',$language);
        }
        
        if(Request::isMethod('post')){
            $validator  = Validator::make(Input::all(), array(
                'name'      => 'required',
                's_name'    => 'required',
                'l_code'    => 'required'
            ));
            
            if($validator->passes()){
                
                $name   = Input::get('name');
                $s_name = Input::get('s_name');
                $l_code = Input::get('l_code');
                
                $check_langugage = Language::where(array(
                                        'name'              => $name,
                                        'simplified_name'   => $s_name,
                                        'code'              => $l_code
                                    ));
                
                if($check_langugage->count()){
                    return Redirect::secure('/9gag-admin/language')
                    ->with('languagesupdate',"Language already exist...");
                }else{
                    $create =   Language::create(array(
                                    'name'              => $name,
                                    'simplified_name'   => $s_name,
                                    'code'              => $l_code,
                                    'enabled'           => 1
                                ));
                    if($create){
                        return Redirect::secure('/9gag-admin/language')
                                ->with('languagesupdate',"New Language (".$s_name.") Added...");
                    }else{
                        return Redirect::secure('/9gag-admin/language')
                                ->with('languagesupdate',"Something wen't wrong...");
                    }
                }
            }else{
                return Redirect::secure('/9gag-admin/language')
                ->withErrors($validator)
                ->with('languagesupdate',"Error adding new language...");
            }
        }
    }
    
    /**
     * Manage Header Content
     */
    public function look(){
        
        if(Request::isMethod('get')){
            return View::make('admin.authenticated.manage.headerconfigurations');
        }
        
        if(Request::isMethod('post')){
            $title          =   Input::get('title');
            $description    =   Input::get('description');
            $categories     =   Input::get('categories');
            
            $update =   MetaData::where('type','=','details')->update(array(
                            'title'         =>  $title,
                            'description'   =>  $description,
                            'categories'    =>  strtolower($categories)
                        ));
            if($update){
                return Redirect::secure('/9gag-admin/look')->with('lookupdate',"Setting Updated");
            }
        }
        
    }
    
    /**
     * Advertisement Manager
     */
    public function adverts(){
        if(Request::isMethod("get")){
            return View::make('admin.authenticated.manage.adverts');
        }
        
        if(Request::isMethod("post")){
            
            if(Input::hasFile('spot1')){
                $validator  =   Validator::make(Input::all(), array(
                    'spot1' =>  'image|required'
                ));
                
                if($validator->passes()){
                    $spot = '/uploads/partner/spot1.'.Input::file('spot1')->guessClientExtension();
                    Input::file('spot1')->move(public_path().'/uploads/partner/','spot1.'.Input::file('spot1')->guessClientExtension());
                    
                    $ad =   Ads::find(1)->update(array(
                                'uri'   => $spot
                            ));
                    if($ad){
                        return Redirect::secure('/9gag-admin/adverts')->with('spot1update','Advertisement Saved Successfully');
                    }
                    
                    
                }else{
                    return Redirect::secure('/9gag-admin/adverts')->withErrors($validator);
                }
            }
            
            if(Input::hasFile('spot2')){
                $validator  =   Validator::make(Input::all(), array(
                    'spot2' =>  'image|required'
                ));
                
                if($validator->passes()){
                    $spot = '/uploads/partner/spot2.'.Input::file('spot2')->guessClientExtension();
                    Input::file('spot2')->move(public_path().'/uploads/partner/','spot2.'.Input::file('spot2')->guessClientExtension());
                    
                    $ad =   Ads::find(2)->update(array(
                                'uri'   => $spot
                            ));
                    if($ad){
                        return Redirect::secure('/9gag-admin/adverts')->with('spot2update','Advertisement Saved Successfully');
                    }
                }else{
                    return Redirect::secure('/9gag-admin/adverts')->withErrors($validator);
                }
            }
            
            if(Input::hasFile('spot3')){
                $validator  =   Validator::make(Input::all(), array(
                    'spot3' =>  'image|required'
                ));
                
                if($validator->passes()){
                    $spot = '/uploads/partner/spot3.'.Input::file('spot3')->guessClientExtension();
                    Input::file('spot3')->move(public_path().'/uploads/partner/','spot3.'.Input::file('spot3')->guessClientExtension());
                    
                    $ad =   Ads::find(3)->update(array(
                                'uri'   => $spot
                            ));
                    if($ad){
                        return Redirect::secure('/9gag-admin/adverts')->with('spot3update','Advertisement Saved Successfully');
                    }
                }else{
                    return Redirect::secure('/9gag-admin/adverts')->withErrors($validator);
                }
            }
            
            if(Input::hasFile('spot4')){
                $validator  =   Validator::make(Input::all(), array(
                    'spot4' =>  'image|required'
                ));
                
                if($validator->passes()){
                    $spot = '/uploads/partner/spot4.'.Input::file('spot4')->guessClientExtension();
                    Input::file('spot4')->move(public_path().'/uploads/partner/','spot4.'.Input::file('spot4')->guessClientExtension());
                    
                    $ad =   Ads::find(4)->update(array(
                                'uri'   => $spot
                            ));
                    if($ad){
                        return Redirect::secure('/9gag-admin/adverts')->with('spot4update','Advertisement Saved Successfully');
                    }
                }else{
                    return Redirect::secure('/9gag-admin/adverts')->withErrors($validator);
                }
            }
            
            return Redirect::secure('/9gag-admin/adverts');
        }
    }
    
    /**
     * Email Template Settings
     */
    public function emailTemplates(){
        if(Request::isMethod('get')){
            return View::make('admin.authenticated.manage.email');
        }
        
        if(Request::isMethod('post')){
        
            if(Input::get('activate_user')){
                $update =   Emailer::where('type','=','activate_user')->update(array(
                                'title' =>  Input::get('activate_user_title'),
                                'body'  =>  Input::get('activate_user_body'),
                            ));
            
                if($update){
                    return Redirect::secure('/9gag-admin/mail#activate-user')->with('activate_user','Email Setting Updated');
                }
                
                
            }
            
            if(Input::get('recover_user')){
                $update =   Emailer::where('type','=','recover_user')->update(array(
                                'title' =>  Input::get('recover_user_title'),
                                'body'  =>  Input::get('recover_user_body'),
                            ));
            
                if($update){
                    return Redirect::secure('/9gag-admin/mail#recover-user')->with('recover_user','Email Setting Updated');
                }
            }
            
            if(Input::get('subscribe_newsletter')){
                $update =   Emailer::where('type','=','subscribe_newsletter')->update(array(
                                'title' =>  Input::get('subscribe_newsletter_title'),
                                'body'  =>  Input::get('subscribe_newsletter_body'),
                            ));
            
                if($update){
                    return Redirect::secure('/9gag-admin/mail#newsletter')->with('subscribe_newsletter','Email Setting Updated');
                }
            }
            
            if(Input::get('activate_admin')){
                $update =   Emailer::where('type','=','activate_admin')->update(array(
                                'title' =>  Input::get('activate_admin_title'),
                                'body'  =>  Input::get('activate_admin_body'),
                            ));
            
                if($update){
                    return Redirect::secure('/9gag-admin/mail#activate-admin')->with('activate_admin','Email Setting Updated');
                }
            }
        }
    }
    
    /**
     * Remove Adverts
     */
    public function removeAdverts(){
        $id =   Input::get('id');
        
        $ad = Ads::where('id','=',$id)->first();
        
        $uri = $ad->uri;
        
        File::delete(public_path().$uri);
        
        $ad->uri = '';
        
        if($ad->save()){
            return Response::json(true);
        }
    }
}

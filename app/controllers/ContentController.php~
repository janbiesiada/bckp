<?php

class ContentController extends BaseController {
    
    /**
     * Generate Posts Feed
     */
    public function postsFeed(){
     $current_user=Session::get('auth')['username'];
        $current_user_id=Session::get('auth')['id'];
        $blocked_user_names=DB::table('block_users')->get();
        if(Session::has('auth')){
        $block_array=json_decode(json_encode($blocked_user_names), true);
        $report_posts= DB::table('posts')->join('report','report.target','=','posts.p_id')
                        ->where('report.reported_by',Session::get('auth')['username'])->select('posts.p_id')->get();
                        $repor_arr= json_decode(json_encode($report_posts), true);
                      $block_post=DB::table('posts')
                                     ->leftjoin('block_users','block_users.blocked_username','=','posts.username')
                                     ->where('block_users.blocked_by',$current_user)
                                      ->select('posts.p_id')->get();
                             $arr=json_decode(json_encode($block_post), true);
                             $combined_array= array_merge($repor_arr,$arr);
                             }
                             if(!empty($combined_array)){
                             $posts=  Post::orderBy('posts.points', 'DESC')
                        ->orderBy('posts.created_at', 'DESC')
                        ->where('posts.language','=', Session::get('language'))
                       ->WhereNotIn('posts.p_id',array($combined_array))
                         ->WhereNotIn('posts.p_id', function($q){
                            $q->select('posts.p_id')
                                ->from('hashtags')
                                ->WhereIn('tags', function($y){
                                    $y->select('hashtag')
                                        ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                                });
                        }) ->paginate(3);
                             
                        }
                        
                        
                        
                         else{
                      
                         $posts  =   Post::orderBy('points', 'DESC')
                        ->orderBy('created_at', 'DESC')
                        ->where('language','=', Session::get('language'))
                         ->WhereNotIn('p_id', function($q){
                            $q->select('p_id')
                                ->from('hashtags')
                                ->WhereIn('tags', function($y){
                                    $y->select('hashtag')
                                        ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                                });
                        })
                        ->paginate(3);
                        }
            for($i= 0; $i<count($posts); $i++){
            $this->initPostProps($posts[$i]);
            $this->validateVotes($posts[$i]);
            $this->getFirstComment($posts[$i]);
            $this->commentCount($posts[$i]);
            $this->collectPostTags($posts[$i]);
          }
        //echo '<pre>';print_r($posts);exit;
         $code = Language::where('name','=',Session::get('language'))->first()->code;
        return View::make('posts')->with('posts',$posts)->with('category','')->with('code',$code);
    }

    public function checkBlockUsers(&$post)
    {
     
     // echo '<pre>';print_r($blo);exit;
    
    
    }
    public function languageContent(){
        //echo 'hii';exit;
        $code = str_replace('/','',strtok($_SERVER["REQUEST_URI"],'?'));
        $languages = Language::where('code','=',$code);
        //print_r($languages); exit;
        if($languages->count()){
            $language = Language::where('code','=',$code)->first();
            Session::put('language',$language->name);
        $current_user=Session::get('auth')['username'];
        $current_user_id=Session::get('auth')['id'];
        $blocked_user_names=DB::table('block_users')->get();
        if(Session::has('auth')){
        $block_array=json_decode(json_encode($blocked_user_names), true);
        $report_posts= DB::table('posts')->join('report','report.target','=','posts.p_id')
                        ->where('report.reported_by',Session::get('auth')['username'])->select('posts.p_id')->get();
                        $repor_arr= json_decode(json_encode($report_posts), true);
                      $block_post=DB::table('posts')
                                     ->leftjoin('block_users','block_users.blocked_username','=','posts.username')
                                     ->where('block_users.blocked_by',$current_user)
                                      ->select('posts.p_id')->get();
                             $arr=json_decode(json_encode($block_post), true);
                             $combined_array= array_merge($repor_arr,$arr);
                             }
                             if(!empty($combined_array)){
                             $posts=  Post::orderBy('posts.points', 'DESC')
                        ->orderBy('posts.created_at', 'DESC')
                        ->where('posts.language','=', Session::get('language'))
                       ->WhereNotIn('posts.p_id',array($combined_array))
                         ->WhereNotIn('posts.p_id', function($q){
                            $q->select('posts.p_id')
                                ->from('hashtags')
                                ->WhereIn('tags', function($y){
                                    $y->select('hashtag')
                                        ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                                });
                        }) ->paginate(3);
                             
                        } else{
                      
                         $posts  =   Post::orderBy('points', 'DESC')
                        ->orderBy('created_at', 'DESC')
                        ->where('language','=', Session::get('language'))
                         ->WhereNotIn('p_id', function($q){
                            $q->select('p_id')
                                ->from('hashtags')
                                ->WhereIn('tags', function($y){
                                    $y->select('hashtag')
                                        ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                                });
                        })
                        ->paginate(3);
                        }
                            
            for($i= 0; $i<count($posts); $i++){
                $this->initPostProps($posts[$i]);
                $this->validateVotes($posts[$i]);
                $this->getFirstComment($posts[$i]);
                $this->commentCount($posts[$i]);
                $this->collectPostTags($posts[$i]);
                
            }
            return View::make('posts')->with('posts',$posts)->with('category','')->with('code',$code);
            
        }else{
            return "page doesn't eixst";
        }

    }
    
    /**
     * Sorted Content Frest/Hot/GIF
     * 
     * @param   string  $c_type (content type)
     */
    public function ShowCategoriesContent($c_type){
        $current_user=Session::get('auth')['username'];
        $current_user_id=Session::get('auth')['id'];
        if($c_type === "fresh"){
              $blocked_user_names=DB::table('block_users')->get();
         if(Session::has('auth')){
        $block_array=json_decode(json_encode($blocked_user_names), true);
        $report_posts= DB::table('posts')->join('report','report.target','=','posts.p_id')
                        ->where('report.reported_by',Session::get('auth')['username'])->select('posts.p_id')->get();
                        $repor_arr= json_decode(json_encode($report_posts), true);
                      $block_post=DB::table('posts')
                                     ->leftjoin('block_users','block_users.blocked_username','=','posts.username')
                                     ->where('block_users.blocked_by',$current_user)
                                     ->select('posts.p_id')->get();
                             $arr=json_decode(json_encode($block_post), true);
                             $combined_array= array_merge($repor_arr,$arr);
                             }
                             if(!empty($combined_array)){
                             $posts=  Post::orderBy('posts.points', 'DESC')
                        ->orderBy('posts.created_at', 'DESC')
                        ->where('posts.language','=', Session::get('language'))
                       ->WhereNotIn('posts.p_id',array($combined_array))
                         ->WhereNotIn('posts.p_id', function($q){
                            $q->select('posts.p_id')
                                ->from('hashtags')
                                ->WhereIn('tags', function($y){
                                    $y->select('hashtag')
                                        ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                                });
                        }) ->paginate(3);
                             
                        } else{
                      
                         $posts  =   Post::orderBy('points', 'DESC')
                        ->orderBy('created_at', 'DESC')
                        ->where('language','=', Session::get('language'))
                         ->WhereNotIn('p_id', function($q){
                            $q->select('p_id')
                                ->from('hashtags')
                                ->WhereIn('tags', function($y){
                                    $y->select('hashtag')
                                        ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                                });
                        })
                        ->paginate(3);
                        }
              
        }else if($c_type === "hot"){
            
        $blocked_user_names=DB::table('block_users')->get();
        if(Session::has('auth')){
        $block_array=json_decode(json_encode($blocked_user_names), true);
        $report_posts= DB::table('posts')->join('report','report.target','=','posts.p_id')
                        ->where('report.reported_by',Session::get('auth')['username'])->select('posts.p_id')->get();
                        $repor_arr= json_decode(json_encode($report_posts), true);
                      $block_post=DB::table('posts')
                                     ->leftjoin('block_users','block_users.blocked_username','=','posts.username')
                                     ->where('block_users.blocked_by',$current_user)
                                      ->select('posts.p_id')->get();
                             $arr=json_decode(json_encode($block_post), true);
                             $combined_array= array_merge($repor_arr,$arr);
                             }
                             if(!empty($combined_array)){
                             $posts=  Post::orderBy('posts.points', 'DESC')
                        ->orderBy('posts.created_at', 'DESC')
                        ->where('posts.language','=', Session::get('language'))
                       ->WhereNotIn('posts.p_id',array($combined_array))
                         ->WhereNotIn('posts.p_id', function($q){
                            $q->select('posts.p_id')
                                ->from('hashtags')
                                ->WhereIn('tags', function($y){
                                    $y->select('hashtag')
                                        ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                                });
                        }) ->paginate(3);
                             
                        } else{
                      
                         $posts  =   Post::orderBy('points', 'DESC')
                        ->orderBy('created_at', 'DESC')
                        ->where('language','=', Session::get('language'))
                         ->WhereNotIn('p_id', function($q){
                            $q->select('p_id')
                                ->from('hashtags')
                                ->WhereIn('tags', function($y){
                                    $y->select('hashtag')
                                        ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                                });
                        })
                        ->paginate(3);
                        }
        }else if($c_type === "gif"){
             $blocked_user_names=DB::table('block_users')->get();
        if(Session::has('auth')){
        $block_array=json_decode(json_encode($blocked_user_names), true);
        $report_posts= DB::table('posts')->join('report','report.target','=','posts.p_id')
                        ->where('report.reported_by',Session::get('auth')['username'])->select('posts.p_id')->get();
                        $repor_arr= json_decode(json_encode($report_posts), true);
                      $block_post=DB::table('posts')
                                     ->leftjoin('block_users','block_users.blocked_username','=','posts.username')
                                     ->where('block_users.blocked_by',$current_user)
                                      ->select('posts.p_id')->get();
                             $arr=json_decode(json_encode($block_post), true);
                             $combined_array= array_merge($repor_arr,$arr);
                             }
                             if(!empty($combined_array)){
                             $posts=  Post::orderBy('posts.points', 'DESC')
                        ->orderBy('posts.created_at', 'DESC')
                        ->where('posts.language','=', Session::get('language'))
                       ->WhereNotIn('posts.p_id',array($combined_array))
                         ->WhereNotIn('posts.p_id', function($q){
                            $q->select('posts.p_id')
                                ->from('hashtags')
                                ->WhereIn('tags', function($y){
                                    $y->select('hashtag')
                                        ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                                });
                        }) ->paginate(3);
                             
                        } else{
                      
                         $posts  =   Post::orderBy('points', 'DESC')
                        ->orderBy('created_at', 'DESC')
                        ->where('language','=', Session::get('language'))
                         ->WhereNotIn('p_id', function($q){
                            $q->select('p_id')
                                ->from('hashtags')
                                ->WhereIn('tags', function($y){
                                    $y->select('hashtag')
                                        ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                                });
                        })
                        ->paginate(3);
                        }
              
        }else if($c_type === "controversial"){
              /* $reported_by_users=DB::table('report')->join('posts','posts.p_id','=','report.target')
                                              ->where('report.type','post')
                                            ->where('reported_by',Session::get('auth')['username'])
                                             ->select('posts.username')->get();
                          $repo_array=json_decode(json_encode($reported_by_users), true);*/
                         
                        
             $posts  = Post::orderBy('points', 'DESC')
                        ->orderBy('created_at', 'DESC')
                        ->where('language','=', Session::get('language'))
                        ->WhereIn('p_id', function($q){
                            $q->select('p_id')
                                ->from('hashtags')
                                ->WhereIn('tags', function($y){
                                $y->select('hashtag')
                                        ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                                         
                                });
                        })
                        ->paginate(10);
                        /*  if(!empty($repo_array)){
                        for($i=0;$i<count($reported_by_users);$i++){
                       $posts  =   Post::orderBy('points', 'DESC')
                        ->orderBy('created_at', 'DESC')
                        ->where('language','=', Session::get('language'))
                        ->WhereIn('p_id', function($q){
                            $q->select('p_id')
                                ->from('hashtags')
                                ->WhereIn('tags', function($y){
                                  $reported_by_users=DB::table('report')->join('posts','posts.p_id','=','report.target')
                                              ->where('report.type','post')
                                            ->where('reported_by',Session::get('auth')['username'])
                                             ->select('posts.username')->get();
                          $repo_array=json_decode(json_encode($reported_by_users), true);
                                    $y->select('hashtag')
                                        ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                                         
                                });
                        })
                        ->paginate(10);
                
                         }

                        
                       
              }*/
        }
      //echo '<pre>';  print_r($posts);exit;
        for($i= 0; $i<count($posts); $i++){
            $this->initPostProps($posts[$i]);
            $this->validateVotes($posts[$i]);
            $this->getFirstComment($posts[$i]);
            $this->commentCount($posts[$i]);
            $this->collectPostTags($posts[$i]);
        }
        
        
        $code = Language::where('name','=',Session::get('language'))->first()->code;
        if($c_type === "controversial"){if(!empty($report_post)){

            return View::make('hidden_posts')->with('report_posts',$report_post)->with('category',$c_type)->with('code',$code);


        }else{
            return View::make('hidden_posts')->with('posts',$posts)->with('category',$c_type)->with('code',$code);


        }
        }
        return View::make('posts')->with('posts',$posts)->with('category',$c_type)->with('code',$code);;
    }

  
    /**
     * Show Hastag Content
     * 
     * @param string $hashta    (hashta)
     */
    public function ShowHashTagContent($hashta){
    
        $hashtag    =   Tags::where('tags','=',$hashta)
                            ->groupBy('p_id')
                            ->WhereNotIn('p_id', function($q){
                                $q->select('p_id')
                                    ->from('hashtags')
                                    ->WhereIn('tags', function($y){
                                        $y->select('hashtag')
                                            ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                                    });
                            })
                            ->paginate(5);
        
        $posts = []; // for posts collection
        
        foreach($hashtag as $post){
            
            $data   =   Post::where('p_id',$post->p_id)
                        ->where('language','=', Session::get('language'))
                        ->first();
            
            if($data){
                
                $this->initPostProps($data);
                $this->validateVotes($data);
                $this->getFirstComment($data);
                $this->commentCount($data);
                $this->collectPostTags($data);
                
                array_push($posts, $data);  // push collected post to Post dataset array
            }
        }
        $code = Language::where('name','=',Session::get('language'))->first()->code;
        return  View::make('hashtags')
                    ->with('posts',$posts)
                    ->with('hashtags', $hashtag)
                    ->with('hashtitle', '#'.$hashta. ' ' .MetaData::where('type','=','details')->first()->title)
                    ->with('code',$code);
    }
    
    public function ShowHashTagContentControversial($hashta){
        $hashtag    =   Tags::where('tags','=',$hashta)
                            ->groupBy('p_id')
                            ->WhereIn('p_id', function($q){
                                $q->select('p_id')
                                    ->from('hashtags')
                                    ->WhereIn('tags', function($y){
                                        $y->select('hashtag')
                                            ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                                    });
                            })
                            ->paginate(5);
        
        $posts = []; // for posts collection
        
        foreach($hashtag as $post){
            
            $data   =   Post::where('p_id',$post->p_id)
                        ->where('language','=', Session::get('language'))
                        ->first();
            
            if($data){
                
                $this->initPostProps($data);
                $this->validateVotes($data);
                $this->getFirstComment($data);
                $this->commentCount($data);
                $this->collectPostTags($data);
                
                array_push($posts, $data);  // push collected post to Post dataset array
            }
        }
        $code = Language::where('name','=',Session::get('language'))->first()->code;
        return  View::make('hashtags')
                    ->with('posts',$posts)
                    ->with('hashtags', $hashtag)
                    ->with('hashtitle', '#'.$hashta. ' ' .MetaData::where('type','=','details')->first()->title)
                    ->with('code',$code);
    }
    
    /**
     * Categories Content
     * 
     * @params  string $category    (Category)
     */
     
    public function categories($category){
        /*
        |   Collect Distinct p_id's from category table
        */
    
        $categories     =  Category::where('category','=',$category)
                                    ->groupBy('p_id')
                                    ->WhereNotIn('p_id', function($q){
                                        $q->select('p_id')
                                            ->from('hashtags')
                                            ->WhereIn('tags', function($y){
                                                $y->select('hashtag')
                                                    ->from('posts_hidden')
                                                    ->where('username','=',Session::get('auth')['username']);
                                            });
                                    })
                                    ->paginate(5);
         $current_user=Session::get('auth')['username'];
        $current_user_id=Session::get('auth')['id'];
        $blocked_user_names=DB::table('block_users')->get();
        if(Session::has('auth')){
        $block_array=json_decode(json_encode($blocked_user_names), true);
        $report_posts= DB::table('categories')->join('report','report.target','=','categories.p_id')
                        ->where('report.reported_by',Session::get('auth')['username'])->get();
                       $repor_arr= json_decode(json_encode($report_posts), true);
                    //  
                       }
                       if(Session::has('auth') && !empty($repor_arr) ){
                        for($i=0;$i<count($repor_arr);$i++) {
                        $posts=   Category::where('category','=',$category)
                                    ->groupBy('categories.p_id')
                                       ->WhereNotIn('categories.p_id',array($repor_arr[$i]['target']))
                                         ->WhereNotIn('categories.p_id', function($q){
                                            $q->select('categories.p_id')
                                                ->from('hashtags')
                                                ->WhereIn('tags', function($y){
                                    $y->select('hashtag')
                                        ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                                });
                        })
                        
                        ->paginate(5);
                        
                        } }else{
                          $categories= Category::where('category','=',$category)
                                    ->groupBy('p_id')
                                    ->WhereNotIn('p_id', function($q){
                                        $q->select('p_id')
                                            ->from('hashtags')
                                            ->WhereIn('tags', function($y){
                                                $y->select('hashtag')
                                                    ->from('posts_hidden')
                                                    ->where('username','=',Session::get('auth')['username']);
                                            });
                                    })
                                    ->paginate(5);
                        }
                        for($i=0;$i<count($blocked_user_names);$i++){
                         $block_post=DB::table('categories')->join('posts','posts.p_id','=','categories.p_id')
                                     ->leftjoin('block_users','block_users.blocked_by','=','posts.username')
                                     ->where('block_users.blocked_by',$current_user)
                                      ->orWhere('block_users.blocked_username',$current_user)->get();
                         $arr=json_decode(json_encode($block_post), true);
                           if(!empty($arr)){
                           if($arr[$i]['blocked_by'] ==$current_user ){
                       $categories =Category::where('category','=',$category)
                                    ->join('posts','posts.p_id','=','categories.p_id')
                                    ->groupBy('categories.p_id')
                                    ->WhereNotIn('posts.username',array($arr[$i]['blocked_username']))
                                    ->WhereNotIn('categories.p_id', function($q){
                                        $q->select('categories.p_id')
                                            ->from('hashtags')
                                            ->WhereIn('tags', function($y){
                                                $y->select('hashtag')
                                                    ->from('posts_hidden')
                                                    ->where('username','=',Session::get('auth')['username']);
                                            });
                                    })
                                    ->paginate(5);
             }
              if($arr[$i]['blocked_username']==$current_user )
              {
                           $categories =Category::where('category','=',$category)
                                    ->join('posts','posts.p_id','=','categories.p_id')
                                    ->groupBy('categories.p_id')
                                    ->WhereNotIn('posts.username',array($arr[$i]['blocked_by']))
                                    ->WhereNotIn('categories.p_id', function($q){
                                        $q->select('categories.p_id')
                                            ->from('hashtags')
                                            ->WhereIn('tags', function($y){
                                                $y->select('hashtag')
                                                    ->from('posts_hidden')
                                                    ->where('username','=',Session::get('auth')['username']);
                                            });
                                    })
                                    ->paginate(5);
              }}}
              
        $posts = [];    // posts collection
        
        if($categories->count()){   // if posts found under $category
            
            foreach($categories as $post){
                /*
                |   Collect Post data with unqiue p_id's from Category table
                */
                $data = Post::where('p_id',$post->p_id)
                            ->where('language','=', Session::get('language'))
                            ->first();
                            
                if($data){

                    $this->initPostProps($data);
                    $this->validateVotes($data);
                    $this->getFirstComment($data);
                    $this->commentCount($data);
                    $this->collectPostTags($data);                
                
                    array_push($posts, $data);  // push collected post to Post dataset array
                }
            }
        }
        $code = Language::where('name','=',Session::get('language'))->first()->code;
        return View::make('categories')
                    ->with('posts',$posts)
                    ->with('categories', $categories)
                    ->with('category',$category)
                    ->with('code',$code);
    }
    
    
    /**
     * Post Tags
     */
    public function collectPostTags(&$post){
        $tags   =   Tags::where('p_id',$post->p_id)->where('type','=','p')->get();
        $post->tags    = $tags;
        $j = 0;
        foreach($post->tags as $tag){
            $post->tags[$j] = $tag->tags;
            $j++;
        }
    }
    
    /**
     * Count Post Comments
     */
    public function commentCount(&$post){
        $comment_count  =   DB::table('comments')
                                ->select(DB::raw('count(*) as commentcount'))
                                ->where('p_id', '=', $post->p_id)
                                ->get();
        $post->c_count = $comment_count[0]->commentcount;
    }
    
    /**
     * Init Post Default Values
     */
    public function initPostProps(&$post){
        $post->up    = false;
        $post->down   = false;
    }
    
    /**
     * Validate Post Votes
     */
    public function validateVotes(&$post){
        $post_votes =   Vote::where('target',$post->p_id)
                                ->where('type','post')
                                ->where('username',Session::get('auth')['username'])
                                ->get();
            
        if($post_votes->count()){
            $post->up   = ($post_votes->first()->up ==1) ? true: false;
            $post->down = ($post_votes->first()->down ==1) ? true: false;
        }
    }
    
    /**
     * Fetch Top Comment For Post
     */
    public function getFirstComment(&$post){
        $post->first_comment    =   Comment::orderBy('points', 'DESC')
                                            ->where('p_id', '=', $post->p_id)
                                            ->get()
                                            ->first();
            
        if($post->first_comment){
            $post->first_comment->comment_user_dp   =   User::where('username','=',$post->first_comment->username)
                                                            ->first()
                                                            ->dp_uri;
            
            $this->initCommentProps($post->first_comment);
            $this->commentTimestamp($post->first_comment);
            $this->validateCommentVotes($post->first_comment);
        }
    }
    
    /**
     * Validate Comment Votes
     */
    public function validateCommentVotes(&$comment){
        $c_points   =   Vote::where('target',$comment->id)
                            ->where('type','comment')
                            ->where('username',Session::get('auth')['username'])
                            ->get();
                    
        if($c_points->count()){
            
            foreach($c_points as $point){  

                if($point->up == 1){
                    if($point->username === Session::get('auth')['username']){
                        $comment->up = true;
                    }
                }
                        
                if($point->down == 1){
                    if($point->username === Session::get('auth')['username']){
                        $comment->down = true;
                    }
                }
            }
        }
    }
    
    /**
     * Init Comment Props
     */
    public function initCommentProps(&$comment){
        $comment->pts   =   0;
        $comment->up    =   false;
        $comment->down  =   false;
    }
    
    /**
     * Comment Timestamp
     */
     public function commentTimestamp(&$comment){
         
        $ago = date('Y-m-d H:i:s', strtotime($comment->created_at));
        $UTC = new DateTimeZone("UTC");
        $newTZ = new DateTimeZone(Session::get('timezone'));
        $date = new DateTime($ago, $UTC );
        $date->setTimezone( $newTZ );
        $comment->tstamp  =   TimeZoneController::getElapsedTime($date->format('Y-m-d H:i:s'));
    
     }
    
    
    public function hidePost(){
        $username       = Session::get('auth')['username'];
        $tag            = Input::get('tag');
        $reason         = Input::get('reason');
        if(Authenticate::hasAuth()){
            
            Hide::create(array(
                'hashtag'   => $tag,
                'username'  => $username,
                'reason'    => $reason
            ));
            
            return Response::json(array(
                'status'    => true,
                'tag'       => $tag
            ));
            
        }else{
            return Response::json(array(
                'status'    => false,
            ));
        }
    }
    
     public function hidePostReport(){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
      $username       = Session::get('auth')['username']; 
      $pid            = Input::get('pid');
      $result = Post::join('report','report.target','=','posts.p_id')
                          ->join('hashtags','hashtags.p_id','=','posts.p_id')
                          ->where('posts.p_id',$pid)
                          ->get();
     
      $reason         = $result[0]->reason;
       $tag         =  $result[0]->tags;
       $username = $result[0]->reported_by;
        //if(Authenticate::hasAuth()){
            
            Hide::create(array(
                'hashtag'   => $tag,
                'username'  => $username,
                'reason'    => $reason
            ));
           $new = new AdminController();
            return Redirect::secure('/9gag-admin');
            
            
        /*}else{
            return Response::json(array(
                'status'    => false,
            ));
        }*/
    }
    
    public function followTag(){
        $p_id           = Input::get('post_id');
        $username       = Session::get('auth')['username'];
        $tag            = Input::get('tag');
        
        if(Authenticate::hasAuth()){
            $hide = Hide::where('hashtag','=',$tag);
            
            
            if($hide->delete()){
                $count = Hide::where('username','=',$username)->count();
                return Response::json(array(
                    'status'    => true,
                    'tag'       => $tag,
                    'count'     => $count
                ));
            }else{
                
                return Response::json(array(
                    'status'    => false,
                    'tag'       => $tag
                ));
            }
        }
    }
    
    public function suggestions(){
        $code = Language::where('name','=',Session::get('language'))->first()->code;
        return View::make('suggestions')->with('code',$code);
    }
    /*function to send subscriptions suggestions*/
     public function subscriptionSummary(){
        $code = Language::where('name','=',Session::get('language'))->first()->code;
        return View::make('subscription_summary')->with('code',$code);
    }
    
    public function suggestionsAccept(){
        $tag    = Input::get('tag');
        $p_id   = Input::get('pid');
        
        $suggestions    =   TagSuggests::where('p_id','=',$p_id)
                                    ->where('tags','=',$tag)
                                    ->where('owner','=',Session::get('auth')['username']);
        
        if($suggestions->delete()){
            $lang = Post::where('p_id','=',$p_id)->first()->language;
            $create =   Tags::create(array(
                            'p_id'      =>  $p_id,
                            'tags'      =>  $tag,
                            'language'  =>  $lang,
                            'type'      =>  's'
                        ));
            if($create){
                return Response::json(array('status' => 'success'));
            }
            return Response::json(array('status' => 'failure'));
        }
        return Response::json(array('status' => 'failure'));
    }
    
    public function suggestionsDecline(){
        $tag    = Input::get('tag');
        $p_id   = Input::get('pid');
        
        $suggestions    =   TagSuggests::where('p_id','=',$p_id)
                                    ->where('tags','=',$tag)
                                    ->where('owner','=',Session::get('auth')['username']);
        
        if($suggestions->delete()){
            return Response::json(array('status' => 'success'));
        }
        return Response::json(array('status' => 'failure'));
    }
    
    public function subscriptionAccept(){
         $get_follower_id=Follow::where('user_id','=',Session::get('auth')['id'])
                                 ->where('subscribed', 'no')->select('follower_id')->get();
            for($i=0;$i<count($get_follower_id);$i++)
            {
               $follower[$i]['follower_id']=$get_follower_id[$i]['follower_id'];
               $subscriptions    =   Follow::where('follower_id','=',$follower[$i]['follower_id'])
                                                ->where('user_id','=',Session::get('auth')['id'])
                                                ->update(array('subscribed' => 'yes'));
                                      }
                  if($subscriptions){
                  return Redirect::secure('/')->with('global','Accepted subscription successfully.');
                   }
                return Response::json(array('status' => 'failure'));
    }
    
    public function subscriptionDecline(){
       $get_follower_id=Follow::where('user_id','=',Session::get('auth')['id'])
                                 ->where('subscribed', 'no')->select('follower_id')->get();
            for($i=0;$i<count($get_follower_id);$i++)
            {
               $follower[$i]['follower_id']=$get_follower_id[$i]['follower_id'];
               $subscriptions    =   Follow::where('follower_id','=',$follower[$i]['follower_id'])
                                                ->where('user_id','=',Session::get('auth')['id'])->where('subscribed','=','no');
                                      }
                if($subscriptions->delete()){
                 return Redirect::secure('/')->with('global','Declined subscription successfully.');
                   }
                return Response::json(array('status' => 'failure'));


    }
    public function filterBlockUserData(){
       $current_user=Session::get('auth')['username'];
        $current_user_id=Session::get('auth')['id'];
        $blocked_user_names=DB::table('block_users')->get();
        $block_array=json_decode(json_encode($blocked_user_names), true);
        for($i=0;$i<count($blocked_user_names);$i++){
        $block_post=DB::table('posts')->leftjoin('block_users','block_users.blocked_username','=','posts.username')->where('block_users.blocked_by',$current_user)->orWhere('block_users.blocked_username',$current_user)->get();
             $arr=json_decode(json_encode($block_post), true);
              if(!empty($arr)){
             if($arr[$i]['blocked_by'] ==$current_user ){
             $get_posts= DB::table('posts')->WhereNotIn('posts.username',array($arr[$i]['blocked_username']))->orderBy('points', 'DESC')
                        ->orderBy('created_at', 'DESC')
                        ->where('language','=', Session::get('language'))
                        ->WhereNotIn('p_id', function($q){
                            $q->select('p_id')
                                ->from('hashtags')
                                ->WhereIn('tags', function($y){
                                    $y->select('hashtag')
                                        ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                               });
                                })
                       
                        ->paginate(3); 
             // echo '<pre>';print_r($get_posts);exit;
              }
              if($arr[$i]['blocked_username']==$current_user )
              {
              $get_posts= DB::table('posts')->WhereNotIn('posts.username',array($arr[$i]['blocked_by']))->orderBy('points', 'DESC')
                        ->orderBy('created_at', 'DESC')
                        ->where('language','=', Session::get('language'))
                        ->WhereNotIn('p_id', function($q){
                            $q->select('p_id')
                                ->from('hashtags')
                                ->WhereIn('tags', function($y){
                                    $y->select('hashtag')
                                        ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                               });
                                })
                       
                        ->paginate(3);
             // echo '<pre>';print_r($get_posts);exit;
              }}
             else{
             $get_posts= DB::table('posts')->orderBy('points', 'DESC')
                        ->orderBy('created_at', 'DESC')
                        ->where('language','=', Session::get('language'))
                        ->WhereNotIn('p_id', function($q){
                            $q->select('p_id')
                                ->from('hashtags')
                                ->WhereIn('tags', function($y){
                                    $y->select('hashtag')
                                        ->from('posts_hidden')
                                        ->where('username','=',Session::get('auth')['username']);
                               });
                                })
                       
                        ->paginate(3);
            //  echo '<pre>';print_r($get_posts);exit;
             }
                               
     }
    }
    
 }

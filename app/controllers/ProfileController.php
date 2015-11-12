<?php

class ProfileController extends BaseController {

    public function userProfile($username) {
        $check_user = User::where('username', '=', $username);
        if ($check_user->count()) {
            $user = $check_user->first();

            $posts = Post::orderBy('created_at', 'DESC')->where('username', '=', $username)->paginate(10);
            $banned_user_array = DB::table('block_users')->where('blocked_by', '=',Session::get('auth')['username'])->get();
            $banned_users = [];
            foreach ($banned_user_array as $b_user) {
                array_push($banned_users, $b_user->blocked_username);
            }
            $i = 0;
            /* Loop Through every post */
            foreach ($posts as $v) {

                /* Initially Set Post Points */
                $posts[$i]->pts = 0;

                $posts[$i]->up = false;
                $posts[$i]->down = false;

                /* Get All Post from PostVotes Table */
                $get_points = Vote::where('target', $posts[$i]->p_id)
                        ->where('type', 'post')
                        ->where('username', Session::get('auth')['username'])
                        ->get();



                if ($get_points->count()) {   // if votes found

                    /* check every single vote for up and down, increment decrement accordingly */
                    foreach ($get_points as $point) {
                        if ($point->up == 1) {
                            $posts[$i]->pts +=1;

                            if ($point->username === Session::get('auth')['username']) {
                                $posts[$i]->up = true;
                            }
                        }


                        if ($point->down == 1) {
                            $posts[$i]->pts -=1;

                            if ($point->username === Session::get('auth')['username']) {
                                $posts[$i]->down = true;
                            }
                        }
                    }
                } else {
                    /* If no votes found, set value */
                    $posts[$i]->pts = 0;
                }

                /* Get Total Comments Count */
                $comment_count = DB::table('comments')->select(DB::raw('count(*) as commentcount'))->where('p_id', '=', $posts[$i]->p_id)->get();
                $posts[$i]->c_count = $comment_count[0]->commentcount;


                /* Get All HashTags From HashTags Table */
                $tags = Tags::where('p_id', $posts[$i]->p_id)->get();
                $posts[$i]->tags = $tags;
                $j = 0;
                foreach ($posts[$i]->tags as $tag) {
                    $posts[$i]->tags[$j] = $tag->tags;
                    $j++;
                }
                $i++;
            }

            $code = Language::where('name', '=', Session::get('language'))->first()->code;
            return View::make('profile.user')->with('user', $user)->with('posts', $posts)->with('code', $code)->with('banned_users', $banned_users);
        } else {
            return Redirect::secure('/')->with('global', 'Profile doesn\'t Exist');
        }
    }

    /*
      |   User Profile Comments View Functionality
     */

    public function userProfileComments($username) {
        $check_user = User::where('username', '=', $username)->get();
        if ($check_user->count()) {

            $user = $check_user->first();

            $comments = Comment::where("username", "=", $username)->orderBy('created_at', 'DESC')->orderBy('created_at', 'DESC')->groupBy('p_id')->paginate(5);
            if ($comments->count()) {

                $i = 0;
                foreach ($comments as $comment) {
                    $comments[$i]->p_id = $comment->p_id;

                    $comments[$i]->post = Post::where('p_id', '=', $comments[$i]->p_id)->get()->first();

                    $comments[$i]->post->up = false;
                    $comments[$i]->post->down = false;

                    $get_points = Vote::where('target', $comments[$i]->post->p_id)
                            ->where('type', 'post')
                            ->where('username', Session::get('auth')['username'])
                            ->get();

                    if ($get_points->count()) {   // if votes found

                        /* check every single vote for up and down, increment decrement accordingly */
                        foreach ($get_points as $point) {
                            if ($point->up == 1) {
                                if ($point->username === Session::get('auth')['username']) {

                                    $comments[$i]->post->up = true;
                                }
                            }


                            if ($point->down == 1) {


                                if ($point->username === Session::get('auth')['username']) {
                                    $comments[$i]->post->down = true;
                                }
                            }
                        }
                    }

                    /* Get Total Comments Count */
                    $comment_count = DB::table('comments')
                            ->select(DB::raw('count(*) as commentcount'))
                            ->where('p_id', '=', $comments[$i]->post->p_id)
                            ->get();

                    $comments[$i]->post->c_count = $comment_count[0]->commentcount;


                    /* Get All HashTags From HashTags Table */
                    $tags = Tags::where('p_id', $comments[$i]->post->p_id)->get();
                    $comments[$i]->post->tags = $tags;
                    $j = 0;
                    foreach ($comments[$i]->post->tags as $tag) {
                        $comments[$i]->post->tags[$j] = $tag->tags;
                        $j++;
                    }


                    $i++;
                }
            }
            $code = Language::where('name', '=', Session::get('language'))->first()->code;
            return View::make('profile.comments')->with('user', $user)->with('comments', $comments)->with('code', $code);
        } else {
            return Redirect::secure('/')->with('global', 'Profile doesn\'t Exist');
        }
    }

    public function userProfileUpVotes($username) {
        $check_user = User::where('username', '=', $username)->get();
        if ($check_user->count()) {

            $user = $check_user->first();

            $votes = Vote::where('username', '=', $username)
                    ->where('type', '=', 'post')
                    ->where('up', '=', 1)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(5);


            if ($votes->count()) {

                $i = 0;
                foreach ($votes as $vote) {
                    $votes[$i]->p_id = $vote->p_id;

                    $votes[$i]->post = Post::where('p_id', '=', $votes[$i]->target)->get()->first();

                    $votes[$i]->post->up = false;
                    $votes[$i]->post->down = false;

                    $get_points = Vote::where('target', $votes[$i]->post->p_id)
                            ->where('type', 'post')
                            ->where('username', Session::get('auth')['username'])
                            ->get();




                    if ($get_points->count()) {   // if votes found

                        /* check every single vote for up and down, increment decrement accordingly */
                        foreach ($get_points as $point) {
                            if ($point->up == 1) {
                                if ($point->username === Session::get('auth')['username']) {

                                    $votes[$i]->post->up = true;
                                }
                            }


                            if ($point->down == 1) {


                                if ($point->username === Session::get('auth')['username']) {
                                    $votes[$i]->post->down = true;
                                }
                            }
                        }
                    }

                    /* Get Total Comments Count */
                    $comment_count = DB::table('comments')
                            ->select(DB::raw('count(*) as commentcount'))
                            ->where('p_id', '=', $votes[$i]->post->p_id)
                            ->get();

                    $votes[$i]->post->c_count = $comment_count[0]->commentcount;


                    /* Get All HashTags From HashTags Table */
                    $tags = Tags::where('p_id', $votes[$i]->post->p_id)->get();
                    $votes[$i]->post->tags = $tags;
                    $j = 0;
                    foreach ($votes[$i]->post->tags as $tag) {
                        $votes[$i]->post->tags[$j] = $tag->tags;
                        $j++;
                    }
                    $i++;
                }
            }
            $code = Language::where('name', '=', Session::get('language'))->first()->code;
            return View::make('profile.upvotes')->with('user', $user)->with('votes', $votes)->with('code', $code);
        } else {
            return Redirect::secure('/')->with('global', 'Profile doesn\'t Exist');
        }
    }

    public function userProfileBadges($username) {
        $check_user = User::where('username', '=', $username)->get();
        if ($check_user->count()) {

            $user = $check_user->first();
            return View::make('profile.badges.reacting')->with('user', $user);
        } else {
            return Redirect::secure('/')->with('global', 'Profile doesn\'t Exist');
        }
    }

    public function awards($username, $award_type) {

        $check_user = User::where('username', '=', $username)->get();
        if ($check_user->count()) {
            $user = $check_user->first();
            if ($award_type === "reacting") {
                return View::make('profile.badges.reacting')->with('user', $user);
            } else if ($award_type === "posting") {
                return View::make('profile.badges.posting')->with('user', $user);
            } else if ($award_type === "achievements") {
                return View::make('profile.badges.achievements')->with('user', $user);
            } else {
                return Redirect::secure('/s/{{$user->username}}/badges');
            }
        } else {
            return Redirect::secure('/')->with('global', 'Profile doesn\'t Exist');
        }
    }

    public function getDetails() {
        if (Session::has('auth')) {
            return Response::json(array(
                        'status' => true,
                        'user' => Session::get('auth')
            ));
        } else {
            return Response::json(array(
                        'status' => false,
                        'user' => ''
            ));
        }
    }

    /* module for follow the user through subscription */

    public function followUser($username) {
        $current_user_id = Session::get('auth')['id'];
        $userid = User::where('username', '=', $username)->select('id')->get();
        if (Follow::where('follower_id', '=', $current_user_id)->count() <= 0) {
            Follow::create(array(
                'user_id' => $userid[0]['id'],
                'follower_id' => $current_user_id
            ));
             
            return Redirect::secure('/s/' . $username)->with('global', 'Successfully subscribed this user.');
        } else {
            return Redirect::secure('/s/' . $username)->with('global', 'Already following this user.');
        }
    }

    /* module for block the user by other user */

    public function blockUser($username) {
        $same_username = Session::get('auth')['username'];
        $block_count = DB::table('block_users')->where('blocked_username', $username)->where('blocked_by', $same_username)->count();
        if ($block_count <= 0) {
            if ($username != $same_username) {
                $block_user = array();
                $block_user['blocked_username'] = $username;
                $block_user['blocked_by'] = $same_username;
                $block_user['status'] = 1;
                DB::table('block_users')->insert($block_user);
                return Redirect::secure('/s/' . $username)->with('global', 'Successfully blocked this user.');
            } else {
                return Redirect::secure('/s/' . $username)->with('global', 'You Can not block yourself.');
            }
        } else {
            return Redirect::secure('/s/' . $username)->with('global', 'You already have blocked this user.');
        }
    }
    
    

}

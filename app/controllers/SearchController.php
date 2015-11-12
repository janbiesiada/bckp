<?php

class SearchController extends BaseController{
    public function search(){
        
        
        if(Request::isMethod("post")){
            
            $tags   =   Tags::orderBy('created_at', 'DESC')
                            ->groupBy('tags')
                            ->where('tags', 'LIKE', ''.Input::get('search').'%')
                            ->WhereNotIn('tags', function($q){
                                $q->select('hashtag')
                                ->from('posts_hidden')
                                ->where('username','=',Session::get('auth')['username']);
                            })
                            ->lists('tags');
            
            return $tags;
        }else{
            $code = Language::where('name','=',Session::get('language'))->first()->code;
            return View::make('search')->with('code',$code)->with('type','searchquery');
            
        }
    }
    
    public function searchControversial(){
        if(Request::isMethod("post")){
            
            $tags   =   Tags::orderBy('created_at', 'DESC')
                            ->groupBy('tags')
                            ->where('tags', 'LIKE', ''.Input::get('search').'%')
                            ->WhereIn('tags', function($q){
                                $q->select('hashtag')
                                ->from('posts_hidden')
                                ->where('username','=',Session::get('auth')['username']);
                            })
                            ->lists('tags');
            
            return $tags;
        }else{
            $code = Language::where('name','=',Session::get('language'))->first()->code;
            return View::make('search')->with('code',$code)->with('type','searchcontroversial');
            
        }
    }
    
    
    public function tags(){
        if(Request::isMethod("post")){
            
            $p_id = Input::get('p_id');
            
            $tags = Tags::where('p_id','=',$p_id)->lists('tags');
            
            return Response::json($tags);

        }
    }
}
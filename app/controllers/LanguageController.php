<?php

class LanguageController extends BaseController{
    
    public function setLanguage($language){
        $options = [
            "English", 
            "繁體中", 
            "簡體中文", 
            "français", 
            "日本語", 
            "Español", 
            "Português",
            "Русский",
            "Türkçe"
        ];
        
        if(in_array($language, $options)){
            Session::put('language',$language);
            return Redirect::secure('/')->with('global','You are viewing posts in '. $language . '!');
        }else{
            return Redirect::secure('/')->with('global','Page doesn\'t Exist');
        }
    }
}
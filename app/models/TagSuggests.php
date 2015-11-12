<?php

class TagSuggests extends Eloquent{
    
    protected $table = 'hashtag_suggestions';
    
    protected $fillable = array(
        'p_id',
        'tags',
        'username',
        'owner'
    );
}
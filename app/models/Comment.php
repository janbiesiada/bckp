<?php

class Comment extends Eloquent{
    
    protected $table = 'comments';
    
    protected $fillable = array(
        'p_id',
        'username',
        'comment',
        'points',
        'show_user'
    );
}
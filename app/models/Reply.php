<?php

class Reply extends Eloquent{
    
    protected $table = 'replies';
    
    protected $fillable = array(
        'comment_id',
        'username',
        'comment',
        'points'
    );
}
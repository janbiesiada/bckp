<?php

class Post extends Eloquent{
    
    protected $table = 'posts';
    
    protected $fillable = array(
        'id',
        'p_id',
        'username',
        'title',
        'uri',
        'source',
        'points',
        'status',
        'language',
        'type',
    );
}
<?php

class Tags extends Eloquent{
    
    protected $table = 'hashtags';
    
    protected $fillable = array(
        'p_id',
        'tags',
        'language',
        'type'
    );
}
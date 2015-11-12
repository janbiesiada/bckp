<?php

class Follow extends Eloquent{
    
    protected $table = 'followers';
    
    protected $fillable = array(
        'follower_id',
        'user_id',
        
    );
}

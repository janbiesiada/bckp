<?php

class Subscribe extends Eloquent{
    
    protected $table = 'subscriptions';
    
    protected $fillable = array(
        'email',
        'verified',
        'code'
    );
}
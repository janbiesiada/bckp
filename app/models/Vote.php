<?php

class Vote extends Eloquent{
    
    protected $table = 'votes';
    
    protected $fillable = array(
        'target',
        'username',
        'type',
        'up',
        'down'
    );
}
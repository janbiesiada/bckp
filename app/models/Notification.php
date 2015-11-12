<?php

class Notification extends Eloquent{
    
    protected $table = 'user_activity';
    
    protected $fillable = array(
        'action_for',
        'action_by',
        'action',
        'target',
        'status',
        'viewed'
    );
}
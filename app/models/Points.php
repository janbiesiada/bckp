<?php

class Points extends Eloquent{
    
    protected $table = 'points';
    
    protected $fillable = array(
        'type',
        'points',
        'username'
    );
}
<?php

class Emailer extends Eloquent{
    
    protected $table = 'mail';
    
    protected $fillable = array(
        'type',
        'title',
        'body'
    );
}
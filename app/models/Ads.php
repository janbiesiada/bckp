<?php

class Ads extends Eloquent{
    
    protected $table = 'ads';
    
    protected $fillable = array(
        'uri',
        'clicks',
        'url'
    );
}
<?php

class MetaData extends Eloquent{
    
    protected $table = 'MetaData';
    
    protected $fillable = array(
        'type',
        'title',
        'description',
        'categories',
        'privacypolicy',
    );
}
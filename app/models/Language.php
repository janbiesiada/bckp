<?php

class Language extends Eloquent{
    
    protected $table = 'languages';
    
    protected $fillable = array(
        'name',
        'simplified_name',
        'code',
        'enabled'
    );
}
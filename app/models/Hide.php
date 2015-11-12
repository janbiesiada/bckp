<?php

class Hide extends Eloquent{
    
    protected $table = 'posts_hidden';
    
    protected $fillable = array(
        'hashtag',
        'username',
        'reason'
    );
}


?>

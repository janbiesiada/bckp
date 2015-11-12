<?php

class ReportUser extends Eloquent{
    
    protected $table = 'report_users';
    
    protected $fillable = array(
        'reported_by',
        'type',
        'target'
        
    );
}

/*
|   Post Report Actions
*/

$(".remove-post-report").on('click', reportPostRemove);

function reportPostRemove(event){
    event.preventDefault();
    
    var pid = $(this).attr('data-pid'),
        rid = $(this).attr('data-reportid');
    
    flaggedPostAction(this,pid,rid,'remove');
}


$(".cancel-post-report").on('click', cancelPostReport);

function cancelPostReport(event){
    event.preventDefault();
    
    var pid = $(this).attr('data-pid'),
        rid = $(this).attr('data-reportid');
        
        
    flaggedPostAction(this,pid,rid,'cancel');
}

function flaggedPostAction(context,_cid,_rid,_action){
    
    $.ajax({
        type    :   'POST',
        url     :   '/9gag-admin/flagged/post',
        data    :   {
            pid     :   _cid,
            rid     :   _rid,
            action  :   _action
        },
        success : function(res){
            if(res.status){
                if(_action === "remove"){
                    $(context).parents('li').slideUp('fast').html('<center>Post has been removed!</center>').fadeIn('fast');
                }else{
                    $(context).parents('li').slideUp('fast').html('<center>Flagged Report has been removed!</center>').fadeIn('fast');;
                }
            }
        }
    });
}
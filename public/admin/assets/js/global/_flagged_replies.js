/*
|   Comment Report Actions
*/

$(".remove-reply-report").on('click', reportRepliesRemove);

function reportRepliesRemove(event){
    event.preventDefault();
    
    var cid = $(this).attr('data-rid'),
        rid = $(this).attr('data-reportid');
    
    flaggedRepliesAction(this,cid,rid,'remove');
}


$(".cancel-reply-report").on('click', cancelRepliesReport);

function cancelRepliesReport(event){
    event.preventDefault();
    
    var cid = $(this).attr('data-rid'),
        rid = $(this).attr('data-reportid');
        
        
    flaggedRepliesAction(this,cid,rid,'cancel');
}

function flaggedRepliesAction(context,_cid,_rid,_action){
    
    $.ajax({
        type    :   'POST',
        url     :   '/9gag-admin/flagged/replies',
        data    :   {
            cid     :   _cid,
            rid     :   _rid,
            action  :   _action
        },
        success : function(res){
            if(res.status){
                if(_action === "remove"){
                    $(context).parents('li').html('<center>Reply has been removed!</center>');
                }else{
                    $(context).parents('li').html('<center>Flagged Report has been removed!</center>');
                }
            }
        }
    });
}
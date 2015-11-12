/*
|   Comment Report Actions
*/

$(".remove-comment-report").on('click', reportCommentRemove);

function reportCommentRemove(event){
    event.preventDefault();
    
    var cid = $(this).attr('data-cid'),
        rid = $(this).attr('data-reportid');
    
    flaggedCommentAction(this,cid,rid,'remove');
}


$(".cancel-comment-report").on('click', cancelCommentReport);

function cancelCommentReport(event){
    event.preventDefault();
    
    var cid = $(this).attr('data-cid'),
        rid = $(this).attr('data-reportid');
        
        
    flaggedCommentAction(this,cid,rid,'cancel');
}

function flaggedCommentAction(context,_cid,_rid,_action){
    
    $.ajax({
        type    :   'POST',
        url     :   '/9gag-admin/flagged/comments',
        data    :   {
            cid     :   _cid,
            rid     :   _rid,
            action  :   _action
        },
        success : function(res){
            console.log(res);
            if(res.status){
                if(_action === "remove"){
                    $(context).parents('li').html('<center>Comment has been removed!</center>');
                }else{
                    $(context).parents('li').html('<center>Flagged Report has been removed!</center>');
                }
            }
        }
    });
}
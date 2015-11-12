$(".remove-reply").on('click', removePostReply);

var $delete_reply_target = '';

function removePostReply(event){
    event.preventDefault();
    
    var $r_id = $(this).attr('data-rid'),
        $c_id = $(this).attr('data-cid');
    
    $delete_reply_target = $(this).parents('.comment-replies');
    
    $(".reply-remove-actions").remove();
    
    var $action =   '<div class="reply-remove-actions">'
                        +'<div class="message">'
                            +'Confirm Delete?'
                        +'</div>'
                        +'<div class="remove-reply-actions">'
                            +'<button type="submit" data-cid="'+$c_id+'" data-rid="'+$r_id+'" class="btn-submit delete">Delete</button>'
                            +'<button type="submit" class="btn-submit cancel">Cancel</button>'
                        +'</div>'
                    +'</div>';

    $($action).hide().appendTo('body').slideDown('fast');
    $(".remove-reply-actions .delete").on('click', deletereply);
    $(".remove-reply-actions .cancel").on('click', hideRemoveReplyAction);
}

function hideRemoveReplyAction(events){
    $(".reply-remove-actions").slideUp('fast', function(){
        $(this).remove();
        $delete_reply_target = '';
    });
}

function deletereply(event){
    event.preventDefault();
    
    var $target     = $(this),
        $r_id       = $(this).attr('data-rid'),
        $c_id       = $(this).attr('data-cid');
    
   $($target).attr('disabled', true);
    $.ajax({
        type : 'POST',
        url  : '/delete/item',
        data : {
            reply_id: $r_id,
            cid     : $c_id,
            target  : 'reply'
        },
        success : function(res){
            if(res){
                $($target).parent().parent().slideUp('fast');
                
                $($delete_reply_target).slideUp('fast', function(){
                    $(this).remove();
                });
            }
            $($target).attr('disabled', false);
        }
    });
}
$(".remove-comment").on('click', removePostComment);

var $delete_comment_target = '';

function removePostComment(event){
    event.preventDefault();
    
    var $c_id = $(this).attr('data-cid');
    
    $delete_comment_target = $(this).parents('ul');
    
    $(".comments-remove-actions").remove();
    
    var $action =   '<div class="comments-remove-actions">'
                        +'<div class="message">'
                            +'Confirm Delete?'
                        +'</div>'
                        +'<div class="remove-comments-actions">'
                            +'<button type="submit" data-cid="'+$c_id+'" class="btn-submit delete">Delete</button>'
                            +'<center><button type="submit" class="btn-submit cancel">Cancel</button></center>'
                        +'</div>'
                    +'</div>';

    $($action).hide().appendTo('body').slideDown('fast');
    $(".remove-comments-actions .delete").on('click', deletecomment);
    $(".remove-comments-actions .cancel").on('click', hideRemoveCommentsAction);
}

function hideRemoveCommentsAction(events){
    $(".comments-remove-actions").slideUp('fast', function(){
        $(this).remove();
        $delete_comment_target = '';
    });
}

function deletecomment(event){
    event.preventDefault();
    
    var $target     = $(this),
        $c_id       = $(this).attr('data-cid');
    
    $($target).attr('disabled', true);
    $.ajax({
        type : 'POST',
        url  : '/delete/item',
        data : {
            comment_id  : $c_id,
            target      : 'comment'
        },
        success : function(res){
            if(res){
                $($target).parent().parent().slideUp('fast');
                
                $($delete_comment_target).slideUp('slow', function(){
                    $(this).remove();
                });
            }
            $($target).attr('disabled', false);
        }
    });
}
$(".edit-reply").on('click', editReply);

function editReply(event){
    event.preventDefault();
    console.log("Edit Reply");
    var $target     =   $(this),
        $rid        =   $($target).attr('data-rid'),
        $reply      =   $($target).parents('.blockquote').children('.reply-body'),
        $options    =   $($reply).parent().children('footer'),
        $original   =   $($reply).children('.reply').text(),
        $actions    =   $($target).parents('.replyactions');
        
    $($reply).children('.reply').hide();
    $($options).hide();
    $($actions).hide();
    
    var $editor =   '<div class="reply-edit">'
                        + '<div class="form-group">' 
                                + '<textarea class="form-control replyedit-text" data-id="' + $rid + '" class="edit-reply" style="resize:none; height: 50px;" placeholder="Leave a reply!" rows="5" name="reply">'+$original+'</textarea>' 
                        + '</div>'
                        + '<div class="actions">'
                            +'<button type="submit" class="btn-submit cancel-reply-edit">Cancel</button>'
                            +'<button type="submit" class="btn-submit save-reply-edit" data-rid="'+$rid+'">Save</button>'
                        + '</div>'
                    +'</div>';
    $($reply).append($editor);
    replyEditEvents();
    $($reply).children('.reply-edit').children('.form-group').children('.replyedit-text').focus();
    
    
}

function replyEditEvents(){
    $(".replyedit-text").unbind('focus',showReplyEditActions);
    $(".replyedit-text").on('focus',showReplyEditActions);
    
    $(".replyedit-text").unbind('blur', hideReplyEditActions);
    $(".replyedit-text").on('blur', hideReplyEditActions);
    
    $(".cancel-reply-edit").unbind('click',hideReplyEditForm);
    $(".cancel-reply-edit").on('click',hideReplyEditForm);
    
    $(".save-reply-edit").unbind('click',saveReplyEdit);
    $(".save-reply-edit").on('click',saveReplyEdit);
}

function showReplyEditActions(event){
    var $target = $(this),
        $actions = $(this).parent().siblings(".actions");

    $($actions).slideDown('fast');
    $($target).attr('placeholder', 'Leave a reply');
}

function hideReplyEditActions(event){
    var $target = $(this),
        $actions = $(this).parent().siblings(".actions");

    if ($target.val().length > 0) {

    } else {
        $($actions).slideUp('fast');
        $($target).attr('placeholder', 'Write a reply!');
    }
}

function hideReplyEditForm(event){
    event.preventDefault();
    
    var $target =   $(this),
        $form   =   $($target).parents('.blockquote');
        
    $($form).children('.reply-body').children('.reply-edit').remove();
    $($form).children('.reply-body').children('.reply').show();
    $($form).children('footer').show();
    $($form).children('.meta').children('.replyactions').show();
}

function saveReplyEdit(event){
    event.preventDefault();
    
    var $target     =   $(this),
        $form       =   $($target).parents('.blockquote'),
        $rid        =   $(this).attr('data-rid'),
        $reply      =   $.trim($(this).parents('.reply-edit').children('.form-group').children('.replyedit-text').val());

    $($target).attr('disabled', true);
    
    $.ajax({
        type    : 'POST',
        url     : '/update/reply',
        data    :   {
            rid     :   $rid,
            reply :   $reply
        },
        success: function(res){
            console.log(res);
            
            if(res){
                $($form).children('.reply-body').children('.reply-edit').remove();
                $($form).children('.reply-body').children('.reply').text($reply).show();
                $($form).children('footer').show();
                $($form).children('.meta').children('.replyactions').show();
            }
            
            $($target).attr('disabled', true);
        }
    });
}
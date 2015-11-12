$(".edit-comment").on('click', editComment);

function editComment(event){
    console.log('Edit Comment');
    event.preventDefault();
    
    var $target     =   $(this),
        $cid        =   $($target).attr('data-cid'),
        $comment    =   $($target).parents('.blockquote').children('.comment-body'),
        $opition    =   $($target).parents('.blockquote').children('footer'),
        $orignal    =   $($comment).children('.comment').text(),
        $actions    =   $($target).parents('.commentactions');
    $($comment).children('.comment').hide();
    $($opition).hide();
    $($actions).hide();
    
    var $editor =   '<div class="comment-edit">'
                        + '<div class="form-group">' 
                                + '<textarea class="form-control commentedit-text" data-id="' + $cid + '" class="edit-reply" style="resize:none; height: 50px;" placeholder="Leave a reply!" rows="5" name="reply">'+$orignal+'</textarea>' 
                        + '</div>'
                        + '<div class="actions">'
                            +'<button type="submit" class="btn-submit cancel-comment-edit">Cancel</button>'
                            +'<button type="submit" class="btn-submit save-comment-edit" data-cid="'+$cid+'">Save</button>'
                        + '</div>'
                    +'</div>';
    $($comment).append($editor);
    
    commentEditEvents();
    
    $($comment).children('.comment-edit').children('.form-group').children('.commentedit-text').focus();
    
    
}


function commentEditEvents(){
    $(".commentedit-text").unbind('focus',showCommentEditActions);
    $(".commentedit-text").on('focus',showCommentEditActions);
    
    $(".commentedit-text").unbind('blur', hideCommentEditActions);
    $(".commentedit-text").on('blur', hideCommentEditActions);
    
    $(".cancel-comment-edit").unbind('click',hideCommentEditForm);
    $(".cancel-comment-edit").on('click',hideCommentEditForm);
    
    $(".save-comment-edit").unbind('click',saveCommentEdit);
    $(".save-comment-edit").on('click',saveCommentEdit);
    
}

function saveCommentEdit(event){
    event.preventDefault();
    
    var $target     =   $(this),
        $form       =   $($target).parents('.blockquote'),
        $cid        =   $(this).attr('data-cid'),
        $comment    =   $.trim($(this).parents('.comment-edit').children('.form-group').children('.commentedit-text').val());

    $($target).attr('disabled', true);
    
    $.ajax({
        type    : 'POST',
        url     : '/update/comment',
        data    :   {
            cid     :   $cid,
            comment :   $comment
        },
        success: function(res){
            console.log(res);
            
            if(res){
                $($form).children('.comment-body').children('.comment-edit').remove();
                $($form).children('.comment-body').children('.comment').text($comment).show();
                $($form).children('footer').show();
                $($form).children('.meta').children('.commentactions').show();
            }
            
            $($target).attr('disabled', true);
        }
    });
    
}

function showCommentEditActions(event) {
    var $target = $(this),
        $actions = $(this).parent().siblings(".actions");

    $($actions).slideDown('fast');
    $($target).attr('placeholder', 'Leave a reply');
}

function hideCommentEditActions(event) {
    var $target = $(this),
        $actions = $(this).parent().siblings(".actions");

    if ($target.val().length > 0) {

    } else {
        $($actions).slideUp('fast');
        $($target).attr('placeholder', 'Write a reply!');
    }
}

function hideCommentEditForm(event){
    event.preventDefault();
    
    var $target =   $(this),
        $form   =   $($target).parents('.blockquote');
        
    $($form).children('.comment-body').children('.comment-edit').remove();
    $($form).children('.comment-body').children('.comment').show();
    $($form).children('footer').show();
    $($form).children('.meta').children('.commentactions').show();
    
    
}
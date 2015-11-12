$(".remove-post").on('click',removeUserPosts);

var $delete_target = '';

function removeUserPosts(event){
    event.preventDefault();
    
    var $p_id = $(this).attr('data-pid');
    
    $delete_target = $(this).parents('.post');
    
    $(".post-remove-actions").remove();
    
    var $action =   '<div class="post-remove-actions">'
                        +'<div class="message">'
                            +'Confirm Delete?'
                        +'</div>'
                        +'<div class="remove-actions">'
                            +'<button type="submit" data-pid="'+$p_id+'" class="btn-submit delete">Delete</button>'
                            +'<button type="submit" class="btn-submit cancel">Cancel</button>'
                        +'</div>'
                    +'</div>';

    $($action).hide().appendTo('body').slideDown('fast');
    $(".remove-actions .delete").on('click', deletePost);
    $(".remove-actions .cancel").on('click', hideRemoveAction);
}

$(".remove-actions .cancel").on('click', hideRemoveAction);

function hideRemoveAction(event){
    event.preventDefault();
    
    $(".post-remove-actions").slideUp('fast', function(){
        $(this).remove();
        
        $delete_target = '';
    });
}

$(".remove-actions .delete").on('click', deletePost);

function deletePost(event){
    event.preventDefault();
    
    var $target     = $(this),
        $p_id       = $(this).attr('data-pid');
    
    $.ajax({
        type : 'POST',
        url  : '/delete/item',
        data : {
            post_id : $p_id,
            target  : 'post'
        },
        success : function(res){
            if(res.status){
                $($target).parent().parent().slideUp('fast');
                
                $($delete_target).slideUp('slow', function(){
                    $(this).remove();
                });
            }
        }
    });
}

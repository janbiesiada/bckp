/*
|   Approve Submitted Content
*/
$(".approve-post").on('click', approvePost);

function approvePost(event){
    event.preventDefault();
    
    var $pid = $(this).attr('data-pid'),
        $parent = $(this).parents('li');
    
    if(!request_check){
        request_check = true;
        
        $.ajax({
           type : 'POST',
           url  : '/9gag-admin/submissions',
           data : {
               'pid' : $pid
           },
           success: function(res){
               
               if(res){
                    $($parent).slideUp('fast').html("Post Approved").addClass('approved').fadeIn('slow');
               }
               
               request_check = false;
           }
        });
    }
}

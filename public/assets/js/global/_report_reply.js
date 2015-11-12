$(".report-reply").on('click', reportCommentReply);

function reportCommentReply(event){
    event.preventDefault();
    
    var $c_id = $(this).attr('data-cid'),
        $r_id = $(this).attr('data-rid');
 
    
    var ask = confirm("Are you sure you want to report this comment?");
    if (ask == true) {
        reportReply($c_id,$r_id);
    }
}


function reportReply(c_id,r_id){
    
    $.ajax({
        type : 'POST',
        url  : '/report/item',
        data : {
            cid     : c_id,
            rid     : r_id,
            type    : 'reply'
        },
        success : function(res){
            if(res){
                console.log(res);
            }
        }
    });
}
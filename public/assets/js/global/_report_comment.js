$(".report-comment").on('click', reportPostComment);

function reportPostComment(event){
    event.preventDefault();
    
    var $c_id = $(this).attr('data-cid');
  
    var ask = confirm("Are you sure you want to report this comment?");
    if (ask == true) {
        reportComment($c_id);
    }
}


function reportComment(id){
    
    $.ajax({
        type : 'POST',
        url  : '/report/item',
        data : {
            cid     : id,
            type    : 'comment'
        },
        success : function(res){
            if(res){
                console.log(res);
            }
        }
    });
}
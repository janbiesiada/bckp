$(".banuser").on('click', banUser);

$(".unbanuser").on('click',unBanUser);

function banUser(e){
    e.preventDefault();
    
    var $target =   $(this),
        $username   = $(this).attr('data-username');
    
    var ask = confirm("Confirm Ban Action");
    if(ask){
        $.ajax({
           type : 'POST',
           url  : '/9gag-admin/ban',
           data : {
               'username' : $username
           },
           success: function(res){
               if(res){
                    $($target).siblings().remove();
                    $($target).removeClass("btn-warning banuser").addClass("btn-success").text("User Banned Successll");
               }
           }
        });
    }
    
    
}


function unBanUser(e){
    e.preventDefault();
    
    var $target =   $(this),
        $username   = $(this).attr('data-username');
    
    var ask = confirm("Confirm UnBan Action");
    if(ask){
        $.ajax({
           type : 'POST',
           url  : '/9gag-admin/unban',
           data : {
               'username' : $username
           },
           success: function(res){
               if(res){
                    $($target).siblings().remove();
                    $($target).removeClass("btn-primary unbanuser").addClass("btn-success").text("User Unban Successfull");
               }
           }
        });
    }
    
}
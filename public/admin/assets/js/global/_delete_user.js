/*
|   Delete User
*/

$(".search-delete-form").on('submit', DeleteUser);

function DeleteUser(event){
    event.preventDefault();
    
    $(".details").remove();
    
    var $username   =   $("#search-delete-username").val();
    
    if(!$username.length > 0){
        var $details    =   '<div class="details">'
                                +'<p class="error"> Enter Username Before Submission!</p>';
                            +'</div>';
    }else{
        
        if(!request_check){
            request_check = true;
            
            $.ajax({
               type : 'POST',
               url  : '/9gag-admin/details',
               data : {
                   'username' : $username
               },
               success: function(res){
                   console.log(res.exist);
                   if(res.exist){
                        var $details    =   '<div class="details">'
                                                +'<button class="remove-user" data-removeid="'+res.user.username+'">Remove User</button>'
                                                +'<div class="profilepic">'
                                                    +'<img src="'+res.user.dp_uri+'"></img>'
                                                +'</div>'
                                                
                                                +'<div class="name">'
                                                    +'<a target="_blank" href="/s/'+res.user.username+'">'+res.user.name+'</a>'
                                                +'</div>'
                                                    
                                                +'<div class="username">'
                                                    +'<a target="_blank" href="/s/'+res.user.username+'">@'+res.user.username+'</a>'
                                                +'</div>'
                                                
                                                
                                                +'<table class="details-table">'
                                                    +'<tr>'
                                                        +'<td>Email</td>'
                                                        +'<td>'+res.user.email+'</td>'
                                                    +'</tr>'
                                                    
                                                    +'<tr>'
                                                        +'<td>Gender</td>'
                                                        +'<td>'+res.user.gender+'</td>'
                                                    +'</tr>'
                                                    
                                                    +'<tr>'
                                                        +'<td>Location</td>'
                                                        +'<td>'+res.user.location+'</td>'
                                                    +'</tr>'
                                                    
                                                    +'<tr>'
                                                        +'<td>Language</td>'
                                                        +'<td>'+res.user.language+'</td>'
                                                    +'</tr>'
                                                    
                                                    +'<tr>'
                                                        +'<td>Member Since </td>'
                                                        +'<td>'+res.user.created_at+'</td>'
                                                    +'</tr>'
                                                    
                                                    +'<tr>'
                                                        +'<td>Total Posts</td>'
                                                        +'<td>'+res.p_count+'</td>'
                                                    +'</tr>'
                                                    
                                                    +'<tr>'
                                                        +'<td>Total Comments</td>'
                                                        +'<td>'+res.c_count+'</td>'
                                                    +'</tr>'
                                                +'</table>'
                                    
                                            +'</div>';
                        
                   }else{
                       var $details    =   '<div class="details">'
                                                +'<p class="error"> User doesn\'t exist!</p>';
                                            +'</div>';
                   }
                   
                   request_check = false;
                   $($details).appendTo('.content .details-wrapper');
                   
                   $(".remove-user").on('click', removeUser);
               }
            });
        }
    }
    
    $($details).appendTo('.content .details-wrapper');
}


$(".remove-user").on('click', removeUser);

function removeUser(){
    var $username   = $(this).attr('data-removeid');
    
    var ask = confirm("Confirm Delete Action");
    if(ask){
        $.ajax({
           type : 'POST',
           url  : '/9gag-admin/delete',
           data : {
               'username' : $username
           },
           success: function(res){
               $(".details").remove();
               if(res){
                    var $details    =   '<div class="details">'
                                            +'<p class="error"> Account has been successfully removed!</p>';
                                        +'</div>';
               }else{
                   var $details    =   '<div class="details">'
                                            +'<p class="error"> Unable to delete account!</p>';
                                        +'</div>';
               }
               
               $($details).appendTo('.content .details-wrapper');
           }
        });
    }
}

$(".deleteuser").on('click', removeUserList);

function removeUserList(e){
    e.preventDefault();
    
    var $target =   $(this),
        $username   = $(this).attr('data-username');
    
    var ask = confirm("Confirm Delete Action");
    if(ask){
        $.ajax({
           type : 'POST',
           url  : '/9gag-admin/delete',
           data : {
               'username' : $username
           },
           success: function(res){
               if(res){
                    $($target).siblings().remove();
                    $($target).removeClass("btn-danger deleteuser").addClass("btn-success").text("User Removed");
               }
           }
        });
    }

}



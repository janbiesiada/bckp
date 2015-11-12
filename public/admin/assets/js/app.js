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

/*
|   Accept/Revoke Admin Access
*/

$(".adminslist .access .approve").on('click', approveAdmin);

function approveAdmin(event){
    event.preventDefault();
    var $username = $(this).attr('data-userid');
    adminActions(this,$username,'approve','approveAdmin');
}

$(".adminslist .access .remove").on('click', removeAdmin);

function removeAdmin(event){
    event.preventDefault();
    var $username = $(this).attr('data-userid');
    adminActions(this,$username,'remove','removeAdmin');
}

$(".adminslist .access .revoke").on('click', removeAdminAccess);

function removeAdminAccess(event){
    event.preventDefault();
    var $username = $(this).attr('data-userid');
    
    adminActions(this,$username,'revoke','removeAdminAccess');
}

function adminActions(context,username,action,handler){
    
    if(!request_check){
        request_check = true;
        
        $.ajax({
           type : 'POST',
           url  : '/9gag-admin/manage',
           data : {
               'action' : action,
               'admin'  : username
           },
           success: function(res){
               
               if(res){
                    window.top.location.reload();
               }
               
               request_check = false;
           }
        });
    }
}
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



/*
|   Comment Report Actions
*/

$(".remove-comment-report").on('click', reportCommentRemove);

function reportCommentRemove(event){
    event.preventDefault();
    
    var cid = $(this).attr('data-cid'),
        rid = $(this).attr('data-reportid');
    
    flaggedCommentAction(this,cid,rid,'remove');
}


$(".cancel-comment-report").on('click', cancelCommentReport);

function cancelCommentReport(event){
    event.preventDefault();
    
    var cid = $(this).attr('data-cid'),
        rid = $(this).attr('data-reportid');
        
        
    flaggedCommentAction(this,cid,rid,'cancel');
}

function flaggedCommentAction(context,_cid,_rid,_action){
    
    $.ajax({
        type    :   'POST',
        url     :   '/9gag-admin/flagged/comments',
        data    :   {
            cid     :   _cid,
            rid     :   _rid,
            action  :   _action
        },
        success : function(res){
            console.log(res);
            if(res.status){
                if(_action === "remove"){
                    $(context).parents('li').html('<center>Comment has been removed!</center>');
                }else{
                    $(context).parents('li').html('<center>Flagged Report has been removed!</center>');
                }
            }
        }
    });
}
/*
|   Post Report Actions
*/

$(".remove-post-report").on('click', reportPostRemove);

function reportPostRemove(event){
    event.preventDefault();
    
    var pid = $(this).attr('data-pid'),
        rid = $(this).attr('data-reportid');
    
    flaggedPostAction(this,pid,rid,'remove');
}


$(".cancel-post-report").on('click', cancelPostReport);

function cancelPostReport(event){
    event.preventDefault();
    
    var pid = $(this).attr('data-pid'),
        rid = $(this).attr('data-reportid');
        
        
    flaggedPostAction(this,pid,rid,'cancel');
}

function flaggedPostAction(context,_cid,_rid,_action){
    
    $.ajax({
        type    :   'POST',
        url     :   '/9gag-admin/flagged/post',
        data    :   {
            pid     :   _cid,
            rid     :   _rid,
            action  :   _action
        },
        success : function(res){
            if(res.status){
                if(_action === "remove"){
                    $(context).parents('li').slideUp('fast').html('<center>Post has been removed!</center>').fadeIn('fast');
                }else{
                    $(context).parents('li').slideUp('fast').html('<center>Flagged Report has been removed!</center>').fadeIn('fast');;
                }
            }
        }
    });
}
/*
|   Comment Report Actions
*/

$(".remove-reply-report").on('click', reportRepliesRemove);

function reportRepliesRemove(event){
    event.preventDefault();
    
    var cid = $(this).attr('data-rid'),
        rid = $(this).attr('data-reportid');
    
    flaggedRepliesAction(this,cid,rid,'remove');
}


$(".cancel-reply-report").on('click', cancelRepliesReport);

function cancelRepliesReport(event){
    event.preventDefault();
    
    var cid = $(this).attr('data-rid'),
        rid = $(this).attr('data-reportid');
        
        
    flaggedRepliesAction(this,cid,rid,'cancel');
}

function flaggedRepliesAction(context,_cid,_rid,_action){
    
    $.ajax({
        type    :   'POST',
        url     :   '/9gag-admin/flagged/replies',
        data    :   {
            cid     :   _cid,
            rid     :   _rid,
            action  :   _action
        },
        success : function(res){
            if(res.status){
                if(_action === "remove"){
                    $(context).parents('li').html('<center>Reply has been removed!</center>');
                }else{
                    $(context).parents('li').html('<center>Flagged Report has been removed!</center>');
                }
            }
        }
    });
}
$(".remove-advert").on('click', removeAdvert);

function removeAdvert(e){
    e.preventDefault();
    
    var $target =   $(this),
        $id     =   $($target).attr('data-id');
        
    var ask = confirm("Confirm Action?");
    
    if(ask){
        $.ajax({
            type    :   'POST',
            url     :   '/9gag-admin/adverts/remove',
            data    :   {
                id  :   $id
            },
            success: function(res){
                console.log(res);
                
                if(res){
                    $($target).unbind('click',removeAdvert);
                    $($target).removeClass("btn-warning remove-advert").addClass("btn-success").text('Advertisement Removed');
                    
                    setTimeout(function(){
                        location.reload();
                    },3000);
                }
            }
        });
    }
}

/*
|   Search User Details
*/

$(".search-details-form").on('submit', searchDetails);

function searchDetails(event){
    event.preventDefault();
    
    $(".details").remove();
    
    var $username   =   $("#search-details-username").val();
    
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
                                                        +'<td>'+res.date+'</td>'
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
               }
            });
        }
    }
    
    $($details).appendTo('.content .details-wrapper');
}
$("#sort-users-list").on('keydown', sortUsersList);

function sortUsersList(event){
    
    var $list = $(".userslist table tr td .username");
    
    if($.trim($(this).val()) == 0){
        $($list).fadeIn('fast');
    }
    
    if(event.which != 13){
        
        
            
        for(var i= 0; i<$list.length; i++){
            var text    =   $($list[i]).text();
                
            if(text.search($.trim($(this).val())) != -1){
                $($list[i]).parents('tr').fadeIn('fast');
            }else{
                $($list[i]).parents('tr').fadeOut('slow');
            }
            
        }
    }else{
        event.preventDefault();
    }

}
$(".unsubscribe").on('click', unsubscribeUser);

function unsubscribeUser(e){
    e.preventDefault();
    
    var $target =   $(this);
        $sub_id =   $(this).attr('data-id');
    
    var ask = confirm("Confirm Action...");
    if(ask){
        $.ajax({
            type    :   'POST',
            url     :   '/9gag-admin/subscriptions',
            data    :   {
                'sub_id'    :   $sub_id
            },
            success :   function(res){
                if(res){
                    $($target).removeClass("btn-danger unsubscribe").addClass('btn-success').text("Unsubscribed");
                }
            }
                
        });
    }
}
'use strict';

/*  
|   Close Global Notification   
*/

var $global_close = $(".global .close"),
    $global_notification = $(".global");

$($global_close).on('click', hideGlobalNotification);

/*  
|   Hide Global Notification after 5 seconds of visibility  
*/
if ($('.global').length) {
    setTimeout(function() {
        $('.global').fadeOut('slow');
    }, 3000);
}

function hideGlobalNotification(event) {
    $($global_notification).fadeOut('slow');
}

var request_check = false;
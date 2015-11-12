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
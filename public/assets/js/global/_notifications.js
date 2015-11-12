
$(".notify").on('click',softReadNotifications);

function softReadNotifications(e){
    e.preventDefault();

    var $target = $(this),
        $notifications = $(".dropdown-menu .notify-action"),
        ids =   [];
    
    //
    for(var i =0; i< $notifications.length ; i++){
        var status  = parseInt($($notifications[i]).attr('data-viewed')),
            id      = parseInt($($notifications[i]).attr('data-id'));
        if(status == 0){
            ids.push(id);
            $($notifications[i]).attr('data-viewed',1);
        }
    }
    
    if(ids.length){
        //console.log(ids);
        
        $.ajax({
           type : 'POST',
           url  : '/s_read/notification',
           data : {
               targets : ids
           },
           success : function(res){
               if(res){
                   $($target).text("");
               }
           }
        });
    }
}

$(".notify-action").on('click', readNotification);


function readNotification(event) {

    var $target = $(this),
        $data_target = $($target).attr('data-target'),
        $action = $($target).attr('data-action');


    event.preventDefault();

    $.ajax({
        type: 'POST',
        url: '/read/notification',
        data: {
            target: $data_target,
            action: $action
        },

        success: function(res) {
            if (res.status) {
                if (window.location.href === res.uri) {
                    window.location.reload();
                } else {
                    window.location = res.uri;
                }
            }
        }
    });


    event.preventDefault();
}

$(".readall-notifications .readall").on('click', function(event) {
    event.preventDefault();
    var $target         = $(this),
        $notifications  = $($target).parents('ul').children('.notify-action'),
        ids             =   [];
    
    
    for(var i =0; i< $notifications.length ; i++){
        var status  = parseInt($($notifications[i]).attr('data-status')),
            id      = parseInt($($notifications[i]).attr('data-id'));
        if(status == 1){
            ids.push(id);
            $($notifications[i]).attr('data-status',0);
        }
    }
    
    if(ids.length){   
        $.ajax({
           type : 'POST',
           url  : '/read_all/notification',
           data : {
               targets : ids
           },
           success : function(res){
               if(res){
                    for(var i =0; i< $notifications.length ; i++){
                        $($notifications[i]).remove();
                    }
                    $($target).parent().parent().append('<p class="no-notifications">No New Notifications</p>');
                    
                    $($target).parent().remove();
               }
           }
        });
    }
    
});

$('.dropdown-menu').click(function(e) {
    e.stopPropagation();
});
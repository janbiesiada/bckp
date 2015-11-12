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
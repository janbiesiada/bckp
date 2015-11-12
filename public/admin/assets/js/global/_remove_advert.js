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

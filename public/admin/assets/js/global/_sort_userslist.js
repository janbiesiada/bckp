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
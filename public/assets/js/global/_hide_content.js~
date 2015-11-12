$(".unfollow-content").on('click',hideContent);

var $delete_target = '';

function hideContent(event){
    $delete_target = $(this).parents('.post');
    event.preventDefault();
    
    var $p_id = $(this).attr('data-pid'),
        $tags_dom = '';
        
    $.ajax({
        type : 'POST',
        url  : '/search/tags',
        data : {
            p_id  : $p_id
        },
        success : function(res){
             
            for(var i = 0; i<res.length ; i++){
               // console.log(res[i]);
                $tags_dom += '<input type="checkbox" name="chk[]" data-pid="'+$p_id+'" data-tag="'+res[i]+'" >'+res[i]+'</br>';
                $tags_dom +='Reason<textarea rows="4" cols="50" class="hiding-reason" id="hiding-reason"></textarea>'
            }
       //     console.log($tags_dom);
            var $action =   '<form  class="hide-content"><div class="post-hide-actions">'
                                +'<div class="message">'
                                    +'Stop Seeing Posts From Any of these tags!'
                                +'</div>'
                                  +'<div class="hide-actions">'
                                    +$tags_dom
                                     +'<button type="submit" class="btn-submit tags">Submit</button>'
                                    +'<button type="submit" class="btn-submit cancel">Cancel</button>'
                                +'</div>'
                            +'</div>'+'</form>';
            $($action).hide().appendTo('body').slideDown('fast');
            $(".hide-content").on('submit', hidePost);
            $(".hide-actions .cancel").on('click', hidePostHideFeatures);
            $('body').click();
            
        }
    });
}

function hidePostHideFeatures(event){
    event.preventDefault();
    
    $(".post-hide-actions").slideUp('fast', function(){
        $(this).remove();
        
        $delete_target = '';
    });
}


function hidePost(event){
    event.preventDefault();
  //console.log(jQuery(this).find("input");
  //  var $target     = $(this),
     //   $p_id       = $(this).attr('data-pid'),
     //   $tag        = $(this).attr('data-tag');
  if(jQuery(".hide-content").find("input:checked").attr("data-pid")){
       var $target   =jQuery(".hide-content").find("input:checked");
        $p_id    =jQuery(".hide-content").find("input:checked").attr("data-pid");
        $tag     =jQuery(".hide-content").find("input:checked").attr("data-tag");
        $reason  =$('.hiding-reason').val();
         $.ajax({
        type : 'POST',
        url  : '/hide/tag',
        data : {
            post_id : $p_id,
            target  : 'post',
            tag     : $tag,
            reason  : $reason 
        },
        success : function(res){
            console.log(res);
            if(res.status){
                $($target).parent().parent().slideUp('fast');
                
                $($delete_target).slideUp('slow', function(){
                    $(this).remove();
                });
                $(".controversy").css("display", "block");
                
                $(".post").each(function(){
                    var $post = $(this),
                        found = false;
                    $($post).find('.tags').each(function(){
                        
                        var $tags = $(this);
                        $($tags).find('.hashtag ').each(function(){
                            var tag = $.trim($(this).find('a').text().replace('#',''));
                            if(res.tag === tag){
                                found = true;
                            }
                        });
                    });
                    if(found){
                        $($post).slideUp('slow');
                    }
                });
            }
        }
    });
                        }else{
                                  alert('You must need to select at least one reason.');

                        }
}

///////////////////////////////////////////////////////////////////////////////

$(".follow-content").on('click',followContent);


function followContent(event){
    event.preventDefault();
    
    var $p_id = $(this).attr('data-pid'),
        $tag  = $(this).parents('.header').children('.hiddenfor').children('.reason').children('a').text();
    
    $delete_target = $(this).parents('.post');
    
    $(".post-follow-actions").remove();
    
    var $action =   '<div class="post-follow-actions">'
                        +'<div class="message">'
                            +'Remove From controversial section?'
                        +'</div>'
                        +'<div class="follow-actions">'
                            +'<button type="submit" data-pid="'+$p_id+'" data-tag="'+$tag+'" class="btn-submit follow-confirm">Unhide</button>'
                            +'<button type="submit" class="btn-submit cancel">Cancel</button>'
                        +'</div>'
                    +'</div>';

    $($action).hide().appendTo('body').slideDown('fast');
    $(".follow-actions .follow-confirm").on('click', followPost);
    $(".follow-actions .cancel").on('click', followPostHideFeatures);
}

$(".follow-actions .cancel").on('click', hidePostHideFeatures);

function followPostHideFeatures(event){
    event.preventDefault();
    
    $(".post-follow-actions").slideUp('fast', function(){
        $(this).remove();
        
        $delete_target = '';
    });
}

$(".follow-actions .follow-confirm").on('click', hidePost);

function followPost(event){
    event.preventDefault();
    
    var $target     = $(this),
        $p_id       = $(this).attr('data-pid'),
        $tag        = $(this).attr('data-tag');
    
    $.ajax({
        type : 'POST',
        url  : '/follow/tag',
        data : {
            post_id : $p_id,
            target  : 'post',
            tag     : $tag
        },
        success : function(res){
            if(res.status){
                $($target).parent().parent().slideUp('fast');
                
                $($delete_target).slideUp('slow', function(){
                    $(this).remove();
                });

                $(".controversy").css("display", "block");
                
                $(".post").each(function(){
                    var $post = $(this),
                        found = false;
                    $($post).find('.tags').each(function(){
                        
                        var $tags = $(this);
                        $($tags).find('.hashtag ').each(function(){
                            var tag = $.trim($(this).find('a').text().replace('#',''));
                            if(res.tag === tag){
                                found = true;
                            }
                        });
                    });
                    if(found){
                        $($post).slideUp('slow');
                    }
                });
            }
        }
    });
}

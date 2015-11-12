$(".report-post").on('click', reportPost);

var $delete_target = '';

function reportPost(event){
 $delete_target = $(this).parents('.post');
    event.preventDefault();
    
    var $pid = $(this).attr('data-pid');
    var $uname = $(this).attr('data-pname');
    console.log($uname);
    $(".post-report-actions").remove();
    
    var $action =   '<div class="post-report-actions">'
                        +'<div class="message">'
                            +'Report Post'
                        +'</div>'
                        
                        +'<div class="report-form">'
                            +'<form id="form-modal-report" class="popup-report" action="" onsubmit="return false;">'
                        		+'<div class="field checkbox">'
                        			+'<label><input name="post-report" type="radio" value="1"> Contains a trademark or copyright violation</label>'
                        		+'</div>'
                        		+'<div class="field checkbox">'
                        			+'<label><input name="post-report" type="radio" value="2"> Spam, blatant advertising, or solicitation</label>'
                        		+'</div>'
                        		+'<div class="field checkbox">'
                        			+'<label><input name="post-report" type="radio" value="3"> Contains offensive materials/nudity</label>'
                        		+'</div>'
                        	+'</form>'
                        +'</div>'
                        +'<div class="report-post-actions">'
                            +'<button type="submit" data-pid="'+$pid+'" class="btn-submit report">Report</button>'
                            +'<button type="submit" class="btn-submit cancel">Cancel</button>'
                        +'</div>'
                    +'</div>';

    $($action).hide().appendTo('body').slideDown('fast');
    $(".report-post-actions .report").on('click', submitReport);
    $(".report-post-actions .cancel").on('click', hidePostReportAction);
}

function hidePostReportAction(events){
    $(".post-report-actions").slideUp('fast', function(){
        $(this).remove();
    });
}

function submitReport(event){
    event.preventDefault();
    var $target     = $(this),
        $pid       = $(this).attr('data-pid');

    
    if (!$("input[name='post-report']").is(':checked')) {
       alert('Please select a reason for report!');
    }
    else {
       // $($target).attr('disabled', true);
        $.ajax({
            type : 'POST',
            url  : '/report/flag',
            data : {
                pid     : $pid,
                type    : 'post',
                reason  : $("input[name='post-report']:checked").val()
            },
            success : function(res){
             //  $(".post-report-actions").remove();
                 $($target).parent().parent().slideUp('fast');
                
                $($delete_target).slideUp('slow', function(){
                    $(this).remove();
                });
               // $(".controversy").css("display", "block");
                
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
                alert("Report has been submitted");
             //   $($target).attr('disabled', false);
            }
        });
    }
    
    
}

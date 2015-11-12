$(".search").on("click", function(e){
    e.preventDefault();
    if(window.location.pathname != "/search"){
        window.location = window.location.origin+"/search";
    }
});

$(".searchquery").on("keyup", search);

function search(e){
    if(e.which == 13){
        e.preventDefault();
    }else{
        $(".tags").empty();
        var query = $(".searchquery").val();
        if($.trim(query).length > 0){
            $.ajax({
                type : 'POST',
                url  : '/search',
                data : {
                    'search' : query
                },
                dataType: "json",
                success : function(res){
                    $(".tags").empty();
                    var data = res;
                    for(var i= 0; i < data.length; i++){
                        $(".tags").append("<a target='_blank' href='/hashtag/"+data[i]+"'><li><span class='hash'>#</span>"+data[i]+"</li></a>");
                        console.log(i);
                    }
                    
                    if(!data.length){
                        $(".tags").append('<center><li><span class="glyphicon glyphicon-search" aria-hidden="true"></span> No Results</li></center>');
                    }
                }
            });
        }
    }
}

$(".searchcontroversial").on("keyup", searchControversial);

function searchControversial(e){
    if(e.which == 13){
        e.preventDefault();
    }else{
        $(".tags").empty();
        var query = $(".searchcontroversial").val();
        if($.trim(query).length > 0){
            $.ajax({
                type : 'POST',
                url  : '/search/controversial',
                data : {
                    'search' : query
                },
                dataType: "json",
                success : function(res){
                    $(".tags").empty();
                    var data = res;
                    for(var i= 0; i < data.length; i++){
                        $(".tags").append("<a target='_blank' href='/controversial/hashtag/"+data[i]+"'><li><span class='hash'>#</span>"+data[i]+"</li></a>");
                        console.log(i);
                    }
                    
                    if(!data.length){
                        $(".tags").append('<center><li><span class="glyphicon glyphicon-search" aria-hidden="true"></span> No Results</li></center>');
                    }
                }
            });
        }
    }
}

if(window.location.pathname === "/search"){
    $(".searchquery").focus();
}else if(window.location.pathname === "/search/controversial"){
    $(".searchcontroversial").focus();
}
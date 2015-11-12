var TimeZoneSettings = {
    setTimeZone  : function(tzone){
        $.ajax({
            type : 'POST',
            url  : '/set_timezone',
                data : {
                    tz   : tzone
                },
            success : function(res){
                if(res.status){
                    console.log("Timezone Updated : ", res.timezone);
                    location.reload();
                }
            }
        });
    }
};
(function($){
    $(document).ready(function(){
        $('input[name*="Deposit"]').change(function(){                    
                    var id = $(this).attr('name').substr(8);
                    var date = new Date();
                    var month = (1 + date.getMonth()).toString();
                    month = month.length > 1 ? month : '0' + month;
                    var day = date.getDate().toString();
                    day = day.length > 1 ? day : '0' + day;
                    var hour = date.getHours().toString();
                    hour = hour.length > 1 ? hour : '0' + hour;
                    var minute = date.getMinutes().toString();
                    minute = minute.length > 1 ? minute : '0' + minute;
                    var second = date.getSeconds().toString();
                    second = second.length > 1 ? second : '0' + second;
                    var datetime = date.getFullYear()+"-"+month+"-"+day+" "+hour+":"+minute+":"+second;
                    id = "DepositTime_" + id;

                    if($(this).attr('checked') === true){
                        $("input[name='"+id+"']").val(datetime);
                        $("span[id='"+id+"']").html(datetime);
                    }else{
                        $("input[name='"+id+"']").val("");
                        $("span[id='"+id+"']").empty();
                    }
            });
        });
})(jQuery);
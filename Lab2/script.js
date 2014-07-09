function Timeline(userid){
    this.userid = userid;
    
    
}

Timeline.prototype.getData = function(){
    var self = this;
    $.ajax({
        url: "functions.php",
        data: {
            call: "getTimeline",
            query: self.userid
        },
        success: function(data){
        var pretty = JSON.stringify(JSON.parse(data),null,2);
        $("#response").append(pretty);
        }
    });
    
    
}

$(document).ready(function(){

$("#search_user").on("click", function(){
    var username = $("#username").val();
    var t = new Timeline(username);
    t.getData();
    
});
    
});
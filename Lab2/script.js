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
         
        $("#response").append(JSON.stringify(data));
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
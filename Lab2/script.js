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
          
        $("#response").append(data);
        }
    });
    
    
}

$(document).ready(function(){
    var t = new Timeline("nishthaquack");
    t.getData();
});
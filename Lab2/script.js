//Uses Timeline Function from functions.php
function Timeline(userid){
    this.userid = userid;
    
    
}
//Uses getTimeline function to receive data
Timeline.prototype.getData = function(){
    var self = this;
    console.log("getting data...");
    $.ajax({ 
        url: "functions.php",
        data: {
            call: "getTimeline",
            query: self.userid
        },
        success: function(data){
            console.log("got data");
            
            self.render(JSON.parse(data));
        }
    });
    
    
    
    
}

//Selects specified data from what is received: user name, screen name, followers, and number of statuses
Timeline.prototype.render = function(raw_data){
   // console.log("render: "+ raw_data[0]);
    var source = $("#timeline_info").html();
    var template = Handlebars.compile(source);
    
    var context = {
        user_name: raw_data[0].user.name,
        screen_name: raw_data[0].user.screen_name,
        followers: raw_data[0].user.followers_count,
        statuses: raw_data[0].user.statuses_count
        
    }   
    var html = template(context);
   //add results to response id in index
   $("#response").append(html)
}




//Uses getSearch Function from functions.php
function GetSearch(querystring){
    this.querystring = querystring;
}

GetSearch.prototype.getData = function(){
    var self = this;
    $.ajax({
        url:"functions.php",
        data:{
            call: "getSearch",
            query: self.querystring
        },
    success: function(data){
        self.render(JSON.parse(data));

    }

    });
}

//Selects specified data from what is received: user name, tweet, and time
GetSearch.prototype.render = function(raw_data){
   // console.log("render: "+ raw_data[0]);
    var source = $("#search_info").html();
    var template = Handlebars.compile(source);
//loops through each result for the specific information
    for(var i=0; i<raw_data.statuses.length; i++){
     var context = {
        username: raw_data.statuses[i].user.name,
        tweet: raw_data.statuses[i].text,
         time:raw_data.statuses[i].created_at


    }
         var html = template(context);

    //add results to response id in index
   $("#response_query").append(html)
        }

}

$(document).ready(function(){

$("#search_user").on("click", function(){
    var username = $("#username").val();
    var t = new Timeline(username);
    t.getData();

});

    $("#search_str").on("click", function(){
        var query = $("#searchstr").val();
        var s = new GetSearch(query);
        s.getData()
    });

});

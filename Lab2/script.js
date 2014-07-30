/**
Creates a class timeline with userid as attribtue
**/

//done by Nishtha (starts here)
function Timeline(userid){
    this.userid = userid;
    
    
}
//getData as method of Timeline calls on the getTimeline from functions.php to get JSON from Twitter API
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

/**
render as a method of Timeline
    Selects specified data from what is received(JSON): user name, screen name, followers, and number of statuses
    Uses handlebars.js to render UI with relevant content
**/
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
   //add results to response div in index
   $("#response").append(html)
}


/**

Nishtha's code ends, Jordan's code starts

Creates class GetSearch with attirbute querystring as entered by user
**/
function GetSearch(querystring, searchindex){
    this.querystring = querystring;
    this.searchindex = searchindex;
}

/**
    getData as a method of GetSearch calls on getSearch from functions.php to get JSON from Twitter API
**/

GetSearch.prototype.getData = function(){
    var self = this;
    $.ajax({
        url:"functions.php",
        data:{
            call: "getSearch",
            query: self.querystring
        },
    success: function(data){
//        self.render(JSON.parse(data));
        console.log(data);

    }

    });
}

/** render as a method of GetSearch
    Selects specified data from what is received (JSON): user name, tweet, and time
    Uses handlebars.js to render UI

**/
GetSearch.prototype.render = function(raw_data){
   // console.log("render: "+ raw_data[0]);

    var html_src = $("#search_info"+this.searchindex).html();
    var response_div = $("#response_query"+this.searchindex);

    var source = html_src;
    var template = Handlebars.compile(source);
//loops through each result for the specific information
    for(var i=0; i<raw_data.statuses.length; i++){
     var context = {
        username: raw_data.statuses[i].user.screen_name,
        tweet: raw_data.statuses[i].text,
         time:raw_data.statuses[i].created_at


    }
         var html = template(context);

    //add results to response div in index
   response_div.append(html)

}

}


/**
    Jordan's code ends here, document.ready done by Nishtha
**/
$(document).ready(function(){

//onclick listener for Go! of search user button, grabs user inputted value and creates instance of Timeline and calls on getData
$("#search_user").on("click", function(){
    var username = $("#username").val();
    var t = new Timeline(username);
    t.getData();

});

//onclick listener for Go! of search query button, grabs uesr inputted value and creates instance of GetSearch and calls on getData
    $("#search_str1").on("click", function(){
        var query = $("#searchstr1").val();
        var s = new GetSearch(query,1);
        s.getData()
    });
//
////create event for search 2 -- N
//
//    $("#search_str2").on("click", function(){
//        var query = $("#searchstr2").val();
//        var s = new GetSearch(query,2);
//        s.getData()
//    });

});

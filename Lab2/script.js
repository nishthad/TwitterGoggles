/**
Creates a class timeline with userid as attribtue
getData as method of Timeline calls on the getTimeline from functions.php to get JSON from Twitter API

render as a method of Timeline
    Selects specified data from what is received(JSON): user name, screen name, followers, and number of statuses
    Uses handlebars.js to render UI with relevant content
**/

function Timeline(userid){
    this.userid = userid;
    
    
}

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


/** Creates class GetSearch with attirbute querystring as entered by user
 getData as a method of GetSearch calls on getSearch from functions.php to get JSON from Twitter API
 render as a method of GetSearch
    Selects specified data from what is received (JSON): user name, tweet, and time
    Uses handlebars.js to render UI
 **/
function Search(querystring, searchindex){
    this.querystring = querystring;
    this.searchindex = searchindex;
}


Search.prototype.getData = function(c){
    var self = this;
    var jsondata;
    console.log("getting search data");
    $.ajax({
        url:"functions.php",
        data:{
            call: "getSearch",
            query: self.querystring
        },
    success: function(data){
        console.log("got search data");
        self.render(JSON.parse(data));

        c.add(JSON.parse(data));

    }

    });

}


Search.prototype.render = function(raw_data){

    var html_src = $("#search_info"+this.searchindex).html();
    var response_div = $("#response_query"+this.searchindex);

    var source = html_src;
    var template = Handlebars.compile(source);

    for(var i=0; i<raw_data.statuses.length; i++){
         var context = {
            username: raw_data.statuses[i].user.screen_name,
            tweet: raw_data.statuses[i].text,
             time:raw_data.statuses[i].created_at
        }
            var html = template(context);
            response_div.append(html)

    }



}

function AddCompare(){
    this.results = [];


}

AddCompare.prototype.add = function(json){
    this.results.push(json);
    console.log(this.results.length);
}

AddCompare.prototype.compare = function(){

    var json1 = this.results[0].statuses;
    var json2 = this.results[1].statuses;
    var self = this;
    for(var i=0; i<json1.length; i++){
        var current_status = json1[i];

        for(var j=0; j<json2.length; j++){
            if(current_status.id == json2[j].id){
                self.render(json2[j]);
                console.log(json2[j].id);
            }
        }
    }

}


AddCompare.prototype.render = function(raw_data){
   console.log("rendering");
    var html_src = $("#combined").html();
    var response_div = $("#combined_results");
    var source = html_src;
    var template = Handlebars.compile(source);
    var context = {
            username: raw_data.user.screen_name,
            tweet: raw_data.text,
             time:raw_data.created_at
        }
            var html = template(context);
            response_div.append(html)
}


$(document).ready(function(){

var c = new AddCompare();


//onclick listener for Go! of search user button, grabs user inputted value and creates instance of Timeline and calls on getData
$("#search_user").on("click", function(){
    var username = $("#username").val();
    var t = new Timeline(username);
    t.getData();

});

//onclick listener for Go! of search query button, grabs uesr inputted value and creates instance of GetSearch and calls on getData
    $("#search_str1").on("click", function(){

        var query = $("#searchstr1").val();
        var s = new Search(query,1);
        s.getData(c)


    });
//
//create event for search 2

    $("#search_str2").on("click", function(){
        var query = $("#searchstr2").val();
        var s = new Search(query,2);
        s.getData(c)
    });

    $("#view_combined").on("click", function(){
       c.compare();
    });


});

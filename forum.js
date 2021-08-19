
function init(){
	// retrieved old cookie (if exists)
	mycookie = document.cookie; 
	cookies = mycookie.split(";");
	lastvisited = cookies[0];

	if (lastvisited!=""){
		str = "</br> Welcome back! </br> </br> Last Visited: </br>" + lastvisited;
		div = document.getElementById("lastvisited");
		div.innerHTML = str;
	}

	// overwrite old cookie 
	date = new Date();
	d="";
	//d = date.getMonth();
	d += date.getMonth() + "/" + date.getDate() + "/" + date.getFullYear() + " at " + date.getHours() +":" + date.getMinutes() + ":" + date.getSeconds();
	document.cookie = d;
	
}

function sendReply(){
container = document.getElementById("postform");
container.innerHTML="";

container.innerHTML += "    Reply to: ";
replyto = document.createElement("input");
replyto.setAttribute("type", "text");
replyto.setAttribute("name", "replyto");
container.appendChild(replyto);

container.innerHTML += "    Username: ";
user = document.createElement("input");
user.setAttribute("type", "text");
user.setAttribute("name", "poster");
container.appendChild(user);

container.innerHTML += "      Topic: ";
topic = document.createElement("input");
topic.setAttribute("type", "text");
topic.setAttribute("name", "topic");
container.appendChild(topic);
container.innerHTML += "</br> </br>";

post = document.createElement("textarea");
post.setAttribute("name", "posttextarea");
post.setAttribute("rows", "10");
post.setAttribute("cols", "130");
//alert("appending");
container.appendChild(post);
//alert(container.innerHTML);

submit = document.createElement("input");
submit.setAttribute("type", "submit");
submit.setAttribute("name", "postnote");
submit.setAttribute("value", "Post!");
container.appendChild(submit);
//alert(container.innerHTML);

}

// creates form dynamically to post a note
function postNote(){
//alert("want to post");
container = document.getElementById("postform");
container.innerHTML="";

container.innerHTML += "    Username: ";
user = document.createElement("input");
user.setAttribute("type", "text");
user.setAttribute("name", "poster");
container.appendChild(user);

container.innerHTML += "      Topic: ";
topic = document.createElement("input");
topic.setAttribute("type", "text");
topic.setAttribute("name", "topic");
container.appendChild(topic);
container.innerHTML += "</br> </br>";

post = document.createElement("textarea");
post.setAttribute("name", "posttextarea");
post.setAttribute("rows", "10");
post.setAttribute("cols", "130");
//alert("appending");
container.appendChild(post);
//alert(container.innerHTML);

submit = document.createElement("input");
submit.setAttribute("type", "submit");
submit.setAttribute("name", "postnote");
submit.setAttribute("value", "Post!");
container.appendChild(submit);
//alert(container.innerHTML);
}

// AJAX TO REFRESH MESSAGES IN THE FORUM
function refreshForum(){
//alert("refreshing");
var xhr = new XMLHttpRequest();

// Get replies if reply button is clicked

// Get chosen topic if any 
chosentopic = "";

radiobuttons = document.getElementsByName('topic');
	for (var i =0; i<radiobuttons.length; ++i){
		if (radiobuttons[i].checked)
			chosentopic = radiobuttons[i].value;
	}

querystr = "topic="+chosentopic;
//alert("query string is " + querystr);

xhr.onreadystatechange = function ()
{

	if (xhr.readyState == 4 && xhr.status == 200)
	{
	//alert("getting result from PHP");
	var result = xhr.responseText;
	//alert(result);
	displayForumPosts(result); 
	
	}
}

	xhr.open("GET", "http://pic.ucla.edu/~disaalda/final_project/getForumPosts.php?"+querystr, true);
	xhr.send(null);

}

/// DISPLAY FORUM POSTS
function displayForumPosts(str) {

container = document.getElementById("forumposts");
container.innerHTML="";

postsarr = str.split("|");
postsarr.pop();
//alert(postsarr);

for (i = 0; i <postsarr.length; ++i){
	postdiv = document.createElement("div");
	postdiv.innerHTML = postsarr[i];
	//alert(postdiv.innerHTML);
	postdiv.setAttribute("class", "postdiv");
	

	reply = document.createElement("input");
	reply.setAttribute("class", "reply");
	reply.setAttribute("type", "button");
	reply.setAttribute("name", "reply");
	reply.setAttribute("value", "Reply");
	reply.setAttribute("onclick", "sendReply()");

	postdiv.appendChild(reply);
	
	container.appendChild(postdiv);
}

}

setInterval("refreshForum()", 500);
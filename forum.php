#!/usr/local/bin/php -d display_errors=STDOUT
<?php print('<?xml version = "1.0" encoding="utf-8"?> ');
print "\n";
print('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"'); print "\n";
print('"http://www.w3.org/TR/xhtml1/DTD/xhtml11.dtd">');
print "\n";
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
<title>Alda's Forum</title>
<link rel="stylesheet" type="text/css" href="forum.css" />
<script type="text/javascript" src="forum.js" > </script>
</head>
<body onload="init()">

	<div id="lastvisited" >
	</div>

	<div id="header">
		<img src="forumlogo.jpg" alt="Forum Logo" >
	</div>
	
	<form action="" method="post">
		
	</form>

	<div id="sidebar">
		<form id="topics" action="" method="get">
			<input type="button" name="postnotebutton" value="Post A Note" onclick="postNote()"/> </br></br>
			<p> Pick a topic of discussion: </p>
			<!--<input type="button" name="addtopicbutton" value="Add a Topic" onclick="addTopic()"/> </br>-->
<?php

$database = "forum.db";          
try  
{     
     $db = new SQLite3($database);
}
catch (Exception $exception)
{
    echo '<p>There was an error connecting to the database!</p>';

    if ($db)
    {
        echo $exception->getMessage();
    }
}
       
$sql = "SELECT * FROM forumposts";
$result = $db->query($sql);
$topics = array();
$uniquetopics = array();

while ($record = $result->fetchArray()){
	array_push($topics, $record['topic']);
	}

sort($topics);

$uniquetopics[0] = $topics[0];

foreach ($topics as $value) {
	if ($uniquetopics[0] != $value)
		array_push($uniquetopics, $value);
}

foreach ($uniquetopics as $value) {
	echo "<input type='radio' name='topic' value='",$value,"' />", $value,"</br>";
}

?>
		</form>
	<div>	

	<div id="forumposts">
	</div>
	
	<div id="sendpost">
		<form id="postform" action="update_database.php" method="post">
		</form>
	</div>

</body>
</html>
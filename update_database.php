#!/usr/local/bin/php -d display_errors=STDOUT
<?php print('<?xml version = "1.0" encoding="utf-8"?> ');
print "\n";
print('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"'); print "\n";
print('"http://www.w3.org/TR/xhtml1/DTD/xhtml11.dtd">');
print "\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="forum.css" />
<title>Forum Succesfully Updated</title> 
</head>
<body>
<p>
<?php

date_default_timezone_set('America/Los_Angeles');
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

$table = "forumposts";
$username = $_POST['poster'];

if (isset($_POST['replyto']))
	$replyto = $_POST['replyto'];
else
	$replyto ="";


$tstamp = time();
$post = $_POST['posttextarea'];
$topic = $_POST['topic'];
$sql = "INSERT INTO forumposts (username, replyto, post, tstamp, topic) VALUES ('$username', '$replyto', '$post', $tstamp, '$topic')";
$result = $db->query($sql);

if ($result)
	print "</br></br><h2>Your post is posted!<h2> </br>";
else
	print "Sorry, we could not post your post.";

print "<a href='forum.php'> Click here to go back to Forum. </a>";
?>
</p>
</body>
</head>
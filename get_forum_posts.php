#!/usr/local/bin/php -d display_errors=STDOUT
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

$chosentopic = $_GET['topic'];

if ($chosentopic!="")
	$sql = "SELECT * FROM forumposts where topic='$chosentopic'";
else 
	$sql = "SELECT * FROM forumposts";
//print $sql;
$result = $db->query($sql);


while($record = $result->fetchArray()) {
		$str = "<span>".$record['username']."</span>  "; 
		
		if($record['replyto'] !="")
			$str.=" <span class='replytext'> in reply to ".$record['replyto']." </span>  ";
		
		$currentts = time();
		$agots = $currentts - $record['tstamp'];
		$days = floor($agots / (3600*24));
		$hrs = floor($agots/3600);
		$min = floor(($agots-($hrs*3600)) /60);
		$sec = floor($agots %60);
		$str .= " $days days, $hrs hours, $min minutes, $sec seconds ago </br>";
		$str .= $record['post']."</br> |";
		
       print "$str";
}

?>

<?php
$ini = parse_ini_file("init.ini");
$host = $ini['host'];
$database = $ini['database'];
$username = $ini['uname'];
$password = $ini['pwd'];

$connection = mysql_connect($host, $username, $password);
if (!$connection){
    die("Error connecting to the database. <br /><br />" . mysql_error());
}

$db_select = mysql_select_db($database);
if (!$db_select){
    die("Error selecting database.<br /><br />" . mysql_error());
}

function getDBResultsArray($dbQuery){
	$dbResults=mysql_query($dbQuery);

	if(!$dbResults){
	    return(mysql_error());
	}
	
	$resultsArray = array();
	if(mysql_num_rows($dbResults) > 0){
		$i = 0;
		while($row = mysql_fetch_array($dbResults)){
			$resultsArray[$i] = $row;
			$i = $i + 1;
		}	
	}else{
	    return(mysql_error());
	}
	
	return $resultsArray;
}

function getDBResultRecord($dbQuery){
	$dbResults=mysql_query($dbQuery);

	if(!$dbResults){
	    return(mysql_error());
	}
	
	return mysql_fetch_assoc($dbResults);
}

function getDBResultAffected($dbQuery){
	$dbResults=mysql_query($dbQuery);
	if($dbResults){
	    return array('updated'=>$dbResults);
	}else{
	    return(mysql_error());
	}
}

function getDBResultInserted($dbQuery,$id){
	$dbResults=mysql_query($dbQuery);
	if($dbResults){
	    return array($id=>mysql_insert_id());
	}else{
	    return(mysql_error());
	}
}
?>

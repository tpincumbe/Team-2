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
		$GLOBALS["_PLATFORM"]->sandboxHeader("HTTP/1.1 500 Internal Server Error");
		die();
	}
	
	$resultsArray = array();
	if(mysql_num_rows($dbResults) > 0){
		while($row = mysql_fetch_assoc($dbResults)){
			$resultsArray[] = $row;
		}	
	}else{
		$GLOBALS["_PLATFORM"]->sandboxHeader('HTTP/1.1 404 Not Found');
		die();
	}
	
	return $resultsArray;
}

function getDBResultRecord($dbQuery){
	$dbResults=mysql_query($dbQuery);

	if(!$dbResults){
		$GLOBALS["_PLATFORM"]->sandboxHeader("HTTP/1.1 500 Internal Server Error");
		die();
	}
	
	return mysql_fetch_assoc($dbResults);
}

function getDBResultAffected($dbQuery){
	$dbResults=mysql_query($dbQuery);
	if($dbResults){
		return array('rowsAffected'=>mysql_affected_rows());
	}else{
		$GLOBALS["_PLATFORM"]->sandboxHeader('HTTP/1.1 500 Internal Server Error');
		die(mysql_error());
	}
}

function getDBResultInserted($dbQuery,$id){
	$dbResults=mysql_query($dbQuery);
	if($dbResults){
		return array($id=>mysql_insert_id());
	}else{
		$GLOBALS["_PLATFORM"]->sandboxHeader('HTTP/1.1 500 Internal Server Error');
		die(mysql_error());
	}
}
?>
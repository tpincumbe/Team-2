<?php
session_start();
$command = "";
$request = "";
//Finds the type or the request (get or post)
switch($_SERVER['REQUEST_METHOD']){
	case 'GET': $request = &$_GET; break;
	case 'POST': $request = &$_POST; break;
	default: $request = &$_GET;

}

if (isset($request['com'])){
	$command = $request['com'];
}

if (strcasecmp($command, 'loginHeader') == 0){
	jsonResponse();
}

function jsonResponse($param = '', $print = true, $header = true) {
	$userName = NULL;
	if (isset($_SESSION['uname'])){
		$userName = $_SESSION['uname'];
	}
	
	$out = array(
		'userName' => $userName
	);    
 
    $out = json_encode($out);
 
    if ($print) {
        if ($header) header('Content-type: application/json');
 
        echo $out;
        return;
    }
 
    return $out;
}
?>

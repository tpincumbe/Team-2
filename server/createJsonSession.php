<?php
session_start();
$command = $_POST['com'];
if (strcasecmp($command, 'loginHeader') == 0){
	jsonResponse();
}

function jsonResponse($param = '', $print = true, $header = true) {
	$userName = $_SESSION['uname'];
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

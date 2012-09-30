<?php
session_start();
$username = 'trey';
$password = 'abc';
$command = $_POST['com'];
if (strcasecmp($command, 'login') == 0){
	$uname = $_POST['username'];
	$pword = $_POST['password'];
	if ($username == $uname && $pword == $password){
		$_SESSION['uname'] = $uname;
		$_SESSION['uid'] = 0;
		jsonResponse(true);
	}else {
		jsonResponse('Username or password does not match');
	}
}

function jsonResponse($param, $print = true, $header = true) {
    if (is_array($param)) {
        $out = array(
            'success' => true
        );
 
        if (is_array($param['data'])) {
            $out['data'] = $param['data'];
            unset($param['data']);
            $out = array_merge($out, $param);
        } else {
            $out['data'] = $param;
        }
 
    } else if (is_bool($param)) {
        $out = array(
            'success' => $param
        );
    } else {
        $out = array(
            'success' => false,
            'errors' => array(
                'reason' => $param
            )
        );
    }
 
    $out = json_encode($out);
 
    if ($print) {
        if ($header) header('Content-type: application/json');
 
        echo $out;
        return;
    }
 
    return $out;
}
?>

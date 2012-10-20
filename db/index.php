<?php
include 'db_helper.php';

$request = "";
//Finds the type or the request (get or post)
switch($_SERVER['REQUEST_METHOD']){
    case 'GET': $request = &$_GET; break;
    case 'POST': $request = &$_POST; break;
    default: $request = &$_GET;
}

//runs the correct function based on a command
if (isset($request['command'])){
    $command = $request['command'];
    if(strcasecmp($command, 'authenticate') == 0){
        if (isset($request['username']) && isset($request['password'])){
            $username = $request['username'];
            $password = $request['password'];
            authenticate($username, $password);
        }
    }
}

/*
 * authenticates a user based on the supplied username and password.
 * returns the account id if the user has been authenticated.
 */
function authenticate($uname, $pwd){
    $dbQuery = sprintf("SELECT accountID,password FROM Account where userName ='" . $uname . "'");
    $result = getDBResultRecord($dbQuery);
    $output = "";
    if (!$result) {
        $output = array("auth" => FALSE);  
    }else {
        if (isset($result['password'])){
            if (strcmp($pwd, $result['password']) == 0){
                $output = array(
                    "auth" => TRUE,
                    "accountID" => $result['accountID']
                    );
            }else {
                $output = array("auth" => FALSE);
            }
        }
    }
    jsonResponse($output);
}

/**
 * Encodes a response to json for the requester 
 */
function jsonResponse($param, $print = true, $header = true) {
    if (is_array($param)) {
        $out = array(
            'success' => true
        );
 
        $out['data'] = $param;
 
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
<?php
session_start();
$username = 'trey';
$password = 'abc';
$vehicle_serial = '1234567890';
$command = "";
if (isset($_POST['com'])){
	$command = $_POST['com'];	
}/* Use this when testing code
  *else if (isset($_GET['com'])){
	$command = $_GET['com'];
}*/

//Checks the login info from login.js
if (strcasecmp($command, 'login') == 0){
	$uname = "";
	$pword = "";
	if (isset($_POST['username']) && isset($_POST['password'])){
		$uname = $_POST['username'];
		$pword = $_POST['password'];
	}
	if ($username == $uname && $pword == $password){
		$_SESSION['uname'] = $uname;
		$_SESSION['uid'] = 0;
		jsonResponse(true);
	}else {
		jsonResponse('Username or password does not match');
	}
//Loads info for the serial number search in myVehicle.js
}else if (strcasecmp($command, 'serialsearch') == 0){
	$serial = "";
	if (isset($_POST['serial'])){
		$serial = $_POST['serial'];	
	}/* Use this when testing code
	  *else if (isset($_GET['serial'])){
		$serial = $_GET['serial'];
	}*/
	
	if (strcasecmp($vehicle_serial, $serial) == 0){
	$_SESSION['tempSerialNumber'] = '1234567890';
	$vehicle = array(
		"found" => true,
		"model" => "2FIVE",
		"fuel" => "Electric 48 V",
		"sub_model" => "4 Passenger",
		"year" => "2012"
	);
	}else {
		$vehicle = array(
			"found" => false
		);
	}
	jsonResponse($vehicle);
//Loads the info for vehicleResults.js
} else if (strcasecmp($command, 'vehicleResultsLoad') == 0){
	//Get the serial number from the session
	$serial = $_SESSION['tempSerialNumber'];
	if (strcasecmp($vehicle_serial, $serial) == 0){
	$vehicle = array(
		"found" => true,
		"model" => "2FIVE",
		"fuel" => "Electric 48 V",
		"sub_model" => "4 Passenger",
		"year" => "2012"
	);
	jsonResponse($vehicle);
	}else {
		jsonResponse("There was an error with the tempSerialNumber in the session.");
	}
//Cancels the vehicle results by removing the temp serial number
} else if (strcasecmp($command, 'vehicleResultsCancel') == 0){
	//Remove the temporary serial number
	$_SESSION['tempSerialNumber'] = "";
	jsonResponse(true);
//Saves the selected vehicle to the session
} else if (strcasecmp($command, 'vehicleResultsSessionSave') == 0){
	$serialNumber = $_SESSION['tempSerialNumber'];	
	//Remove the temporary serial number
	$_SESSION['tempSerialNumber'] = "";
	$_SESSION['currentSerialNumber'] = $serialNumber;
	jsonResponse(true);
//Loads the filter for the parts page
} else if (strcasecmp($command, 'partsLoad') == 0){
	//Get the serial number from the session
	$serial = $_SESSION['currentSerialNumber'];
	if (strcasecmp($vehicle_serial, $serial) == 0){
		$vehicle = array(
			"found" => true,
			"model" => "2FIVE",
			"fuel" => "Electric 48 V",
			"sub_model" => "4 Passenger",
			"year" => "2012"
		);
	}else {
		$vehicle = array(
			"found" => false
		);
	}
	jsonResponse($vehicle);
//Removes the parts filter by removing the current serial number in the session
} else if (strcasecmp($command, 'vehicleFilterCancel') == 0){
	//Remove the session serial number
	$_SESSION['currentSerialNumber'] = "";
	jsonResponse(true);
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

<?php
session_start();
mysql_connect('localhost','cs4911_team20','qqtgyu0O') or die( "Unable to connect");
mysql_select_db('cs4911_team20') or die( "Unable to select database");
$command = "";
$accountVehicle1 = array(
	"found" => true,
	"serialNumber" => 20,
	"model" => "TXT",
	"fuel" => "Electric 48 V",
	"sub_model" => "Submodel A",
	"year" => "2012"
);
$accountVehicle2 = array(
	"found" => true,
	"serialNumber" => 30,
	"model" => "Express",
	"fuel" => "Gas",
	"sub_model" => "Submodel B",
	"year" => "2005"
);
$accountVehicles = array(
	'0' => $accountVehicle1,
	'1' => $accountVehicle2
);
/* A list of all possible com values in the order they appear below
	login - Checks user name and password, saves user to session if successful
	serialsearch - Checks the serial number against known serial numbers and saves
		a match to session if successful
	vehicleResultsLoad - Loads the information of the vehicle about to be selected
	vehicleResultsCancel - Clears the info about the vehicle about to be selected
	vehicleResultsSessionSave - Saves the selected vehicle to the session for filtering
	partsLoad - Loads the currently selected filter for the parts page
	vehicleFilterCancel - Removes the current vehicle filter from the session
	selectModelLoad - Loads the possible model choices for select vehicle
	selectModelSave - Saves the model selection from select vehicle	
	selectFuelLoad - Loads the possible fuel choices for select vehicle
	selectFuelSave - Saves the fuel selection from select vehicle	
	selectSubmodelLoad - Loads the possible submodel choices for select vehicle
	selectSubmodelSave - Saves the submodel selection from select vehicle	
	selectYearLoad - Loads the possible year choices for select vehicle
	selectYearSave - Saves the year selection from select vehicle	
	logout - Logs out the user
	accountVehiclesLoad - Loads the vehicles for the current account
 */

/* A list of all the session variables
	currentSerialNumber - The serial number of the vehicle currently saved in
		the session for parts filtering
	currentVehicle - The info of the vehicle currently saved in
		the session for parts filtering
	tempFuel - The fuel selected in select vehicle
	tempModel - The model id selected in select vehicle
	tempSerialNumber - The serial number of the vehicle that needs to be confirmed
		on the final myVehicle page
	tempSubmodel - The submodel selected in select vehilce
	tempVehicle - The vehicle (with name strings) selected in select vehicle
	tempYear - The year selected in select vehicle.
	uname - The logged in username
	uid - The logged in user id
	
 */

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

//Checks the login info from login.js
if (strcasecmp($command, 'login') == 0){
	$uname = "";
	$pword = "";
        $data = array();
	if (isset($request['username']) && isset($request['password'])){
            $data['command'] = "authenticate";
	    $data['username'] = $request['username'];
            $data['password'] = $request['password'];
	}
        
        $output = do_post_request($data);
        print_r($output);
        echo($output);
        return $output;
//Loads info for the serial number search in myVehicle.js
}else if (strcasecmp($command, 'serialsearch') == 0){
	$serial = "";
	if (isset($request['serial'])){
		$serial = $request['serial'];	
	}
	//Search the database	
	$query = "
		    SELECT vt.serialNumber,
			   mlu.name as model,
			   flu.name as fuel,
			   slu.name as submodel,
			   ylu.name as year
		      FROM Vehicle_Type vt
		INNER JOIN Model_LU mlu
			ON mlu.modelId = vt.modelId
		INNER JOIN Fuel_LU flu
			ON flu.fuelId = vt.fuelId
		INNER JOIN Submodel_LU slu
			ON slu.submodelId = vt.submodelId
		INNER JOIN Year_LU ylu
			ON ylu.yearId = vt.yearId
		     WHERE vt.serialNumber = '$serial'";          
	$result = mysql_query ($query)  or die(mysql_error());
	//Return either the result or that there was no result
	if ($row = mysql_fetch_array($result)) {
		$row['found'] = true;
		$_SESSION['tempSerialNumber'] = $serial;
		jsonResponse($row);
	} else {
		jsonResponse("There were no results.");
	}
//Loads the info for vehicleResults.js
} else if (strcasecmp($command, 'vehicleResultsLoad') == 0){
	//Get the serial number from the session
	$serial = $_SESSION['tempSerialNumber'];
	if (!empty($serial)){
		$query = "    SELECT vt.serialNumber,
				   mlu.name as model,
				   flu.name as fuel,
				   slu.name as submodel,
				   ylu.name as year
			      FROM Vehicle_Type vt
			INNER JOIN Model_LU mlu
				ON mlu.modelId = vt.modelId
			INNER JOIN Fuel_LU flu
				ON flu.fuelId = vt.fuelId
			INNER JOIN Submodel_LU slu
				ON slu.submodelId = vt.submodelId
			INNER JOIN Year_LU ylu
				ON ylu.yearId = vt.yearId
			     WHERE vt.serialNumber = '$serial'";
	}else { 
		//Use a different query if picked from the select screens
		$modelId = $_SESSION['tempModel'];
		$fuelId = $_SESSION['tempFuel'];
		$submodelId = $_SESSION['tempSubmodel'];
		$yearId = $_SESSION['tempYear'];
		$query = "  SELECT vt.serialNumber,
				   mlu.name as model,
				   flu.name as fuel,
				   slu.name as submodel,
				   ylu.name as year
			      FROM Vehicle_Type vt
			INNER JOIN Model_LU mlu
				ON mlu.modelId = vt.modelId
			INNER JOIN Fuel_LU flu
				ON flu.fuelId = vt.fuelId
			INNER JOIN Submodel_LU slu
				ON slu.submodelId = vt.submodelId
			INNER JOIN Year_LU ylu
				ON ylu.yearId = vt.yearId
			     WHERE vt.modelId = '$modelId'
			       AND vt.fuelId = '$fuelId'
			       AND vt.submodelId = '$submodelId'
			       AND vt.yearId = '$yearId'";
	} 
	//Run the query
	$result = mysql_query ($query)  or die(mysql_error());
	//Return either the result or that there was no result
	if ($row = mysql_fetch_array($result)) {
		$row['found'] = true;
		$_SESSION['tempVehicle'] = $row;
		$_SESSION['tempSerialNumber'] = $row['serialNumber'];	
		jsonResponse($row);
	} else {
		jsonResponse("There was an error in the session.");
	}
//Cancels the vehicle results by removing the temp serial number
} else if (strcasecmp($command, 'vehicleResultsCancel') == 0){
	//Remove the temporary serial number
	$_SESSION['tempSerialNumber'] = "";
	$_SESSION['tempModel'] = "";
	$_SESSION['tempFuel'] = "";
	$_SESSION['tempSubmodel'] = "";
	$_SESSION['tempYear'] = "";
	$_SESSION['tempVehicle'] = "";	
	jsonResponse(true);
//Saves the selected vehicle to the session
} else if (strcasecmp($command, 'vehicleResultsSessionSave') == 0){
	$serialNumber = $_SESSION['tempSerialNumber'];	
	$vehicle = $_SESSION['tempVehicle'];	
	//Remove the temporary serial number
	$_SESSION['tempSerialNumber'] = "";
	$_SESSION['tempModel'] = "";
	$_SESSION['tempFuel'] = "";
	$_SESSION['tempSubmodel'] = "";
	$_SESSION['tempYear'] = "";
	$_SESSION['tempVehicle'] = "";	
	$_SESSION['currentSerialNumber'] = $serialNumber;
	$_SESSION['currentVehicle'] = $vehicle;	
	jsonResponse(true);
//Loads the filter for the parts page
} else if (strcasecmp($command, 'partsLoad') == 0){
	//Get the serial number from the session
	$serial = $_SESSION['currentSerialNumber'];
	$vehicle = $_SESSION['currentVehicle'];
	if (strcasecmp($serial, "") == 0) {
		$vehicle = array(
			"found" => false
		);
	}
	jsonResponse($vehicle);
//Removes the parts filter by removing the current serial number in the session
} else if (strcasecmp($command, 'vehicleFilterCancel') == 0){
	//Remove the session serial number
	$_SESSION['currentSerialNumber'] = "";
	$_SESSION['currentVehicle'] = "";
	jsonResponse(true);
//Loads the models for the select model page
}else if (strcasecmp($command, 'selectModelLoad') == 0){
	//Search the databases
	$query = "SELECT *
  		FROM Model_LU";
	$result = mysql_query ($query)  or die(mysql_error());
	$models = array();
	$i = 0;
	//Return all results or that there was no result
	while ($row = mysql_fetch_array($result)) {
		$models[$i] = $row;
		$i = $i + 1;
	} 
	if (!empty($models)) {
		jsonResponse($models);
	} else {
		jsonResponse("There are no models matching this filter.");
	}
//Saves the model id from selectModel.js
} else if (strcasecmp($command, 'selectModelSave') == 0){
	$selectedModel = "";
	if (isset($request['model'])){
		$selectedModel = $request['model'];
	}
	$_SESSION['tempModel'] = $selectedModel;
	jsonResponse("This is a test '$selectedModel");
//Loads the fuels for the select fuel page
}else if (strcasecmp($command, 'selectFuelLoad') == 0){
	//Get the model from the session
	$modelId = $_SESSION['tempModel'];
	//Search the databases
	$query = "    SELECT flu.*
		        FROM Fuel_LU flu
		  INNER JOIN Vehicle_Type vt
	       		  ON vt.fuelId = flu.fuelId
		       WHERE vt.modelId = '$modelId'
		    GROUP BY flu.fuelId";
	$result = mysql_query ($query)  or die(mysql_error());
	$fuels = array();
	$i = 0;
	//Return all results or that there was no result
	while ($row = mysql_fetch_array($result)) {
		$fuels[$i] = $row;
		$i = $i + 1;
	} 
	if (!empty($fuels)) {
		jsonResponse($fuels);
	} else {
		jsonResponse("There are no fuels matching this filter.");
	}
//Saves the fuel id from selectFuel.js
} else if (strcasecmp($command, 'selectFuelSave') == 0){
	$selectedFuel = "";
	if (isset($request['fuel'])){
		$selectedFuel = $request['fuel'];
	}
	$_SESSION['tempFuel'] = $selectedFuel;
	jsonResponse(true);
//Loads the submodels for the select submodel page
}else if (strcasecmp($command, 'selectSubmodelLoad') == 0){
	//Get the model and fuel from the session
	$modelId = $_SESSION['tempModel'];
	$fuelId = $_SESSION['tempFuel'];
	//Search the databases
	$query = "          SELECT slu.*
			      FROM Submodel_LU slu
			INNER JOIN Vehicle_Type vt
				ON vt.submodelId = slu.submodelId
			     WHERE vt.modelId = '$modelId'
			       AND vt.fuelId = '$fuelId'
			  GROUP BY slu.submodelId";
	$result = mysql_query ($query)  or die(mysql_error());
	$submodels = array();
	$i = 0;
	//Return all results or that there was no result
	while ($row = mysql_fetch_array($result)) {
		$submodels[$i] = $row;
		$i = $i + 1;
	} 
	if (!empty($submodels)) {
		jsonResponse($submodels);
	} else {
		jsonResponse("There are no submodels matching this filter.");
	}
//Saves the submodel id from selectSubmodel.js
} else if (strcasecmp($command, 'selectSubmodelSave') == 0){
	$selectedSubmodel = "";
	if (isset($request['submodel'])){
		$selectedSubmodel = $request['submodel'];
	}
	$_SESSION['tempSubmodel'] = $selectedSubmodel;
	jsonResponse(true);
//Loads the years for the select year page
}else if (strcasecmp($command, 'selectYearLoad') == 0){
	//Get the model, fuel and submodel from the session
	$modelId = $_SESSION['tempModel'];
	$fuelId = $_SESSION['tempFuel'];
	$submodelId = $_SESSION['tempSubmodel'];
	//Search the databases
	$query = "  SELECT ylu.*
		      FROM Year_LU ylu
		INNER JOIN Vehicle_Type vt
			ON vt.yearId = ylu.yearId
		     WHERE vt.modelId = '$modelId'
		       AND vt.fuelId = '$fuelId'
		       AND vt.submodelId = '$submodelId'
		  GROUP BY ylu.yearId";
	$result = mysql_query ($query)  or die(mysql_error());
	$years = array();
	$i = 0;
	//Return all results or that there was no result
	while ($row = mysql_fetch_array($result)) {
		$years[$i] = $row;
		$i = $i + 1;
	} 
	if (!empty($years)) {
		jsonResponse($years);
	} else {
		jsonResponse("There are no years matching this filter.");
	}
//Saves the year id from selectYear.js
} else if (strcasecmp($command, 'selectYearSave') == 0){
	$selectedYear = "";
	if (isset($request['year'])){
		$selectedYear = $request['year'];
	}
	$_SESSION['tempYear'] = $selectedYear;
	jsonResponse(true);
//Logs the user out of the session
} else if (strcasecmp($command, 'logout') == 0){
	$_SESSION['uname'] = $uname;
	$_SESSION['uid'] = 0;
//Loads the vehicles for the current user
} else if (strcasecmp($command, 'accountVehiclesLoad') == 0){
	jsonResponse($accountVehicles);
//Saves the selected vehicle to the session as a parts filter
} else if (strcasecmp($command, 'accountVehicleSessionSave') == 0){
	$serialNumber = '';
	$selectedVehicle = '';	
	if (isset($request['serialNumber'])){
		$serialNumber = $request['serialNumber'];
	}
	foreach($accountVehicles as &$curVehicle) {
		if ($curVehicle['serialNumber'] == $serialNumber) {
			$selectedVehicle = $curVehicle;
		}
	}
	unset($curVehicle);
	$_SESSION['currentSerialNumber'] = $serialNumber;
	$_SESSION['currentVehicle'] = $selectedVehicle;
	jsonResponse($_SESSION['currentVehicle']);
}


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

function do_post_request($params, $optional_headers = null){
    $ini = parse_ini_file("init.ini");
    $url = $ini['url'];
    echo("URL:" . $url . "<br />");
    
    // Build Http query using params
    $query = http_build_query ($params);
    
    print_r($query);
    
    // Create Http context details
    $contextData = array ( 
        'method' => 'POST',
        'header' => "Connection: close\r\n".
        "Content-Type: application/x-www-form-urlencoded\r\n".
        "Content-Length: ".strlen($query)."\r\n",
        'content'=> $query
    );
    
    echo("<br/>");
    print_r($contextData);
    echo("<br/>");

    // Create context resource for our request
    $context = stream_context_create (array ( 'http' => $contextData ));
    
    print_r($context);
    echo("<br/>");

    // Read page rendered as result of your POST request
    $result =  file_get_contents ($url, false, $context);
    
    print_r($result);
    
    echo $result;
    return;
}
?>

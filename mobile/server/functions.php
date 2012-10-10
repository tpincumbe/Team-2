
<?php
session_start();
$username = 'trey';
$password = 'abc';
$vehicle_serial = '1234567890';
$command = "";
$model1 = array(
	'id' => 1,
	'name' => 'Shuttle'
);
$model2 = array(
	'id' => 2,
	'name' => 'Terrain'	
);
$models = array(
	'0' => $model1,
	'1' => $model2
);
$fuel1 = array(
	'id' => 10,
	'name' => 'Gas'
);
$fuel2 = array(
	'id' => 20,
	'name' => 'Electric 48V'	
);
$fuels = array(
	'0' => $fuel1,
	'1' => $fuel2
);
$submodel1 = array(
	'id' => 100,
	'name' => '250'
);
$submodel2 = array(
	'id' => 200,
	'name' => '1000'	
);
$submodels = array(
	'0' => $submodel1,
	'1' => $submodel2
);
$year1 = array(
	'id' => 1000,
	'name' => '2011'
);
$year2 = array(
	'id' => 2000,
	'name' => '2012'	
);
$years = array(
	'0' => $year1,
	'1' => $year2
);
$vehicle1 = array(
	'serialNumber' => 1,
	'modelId' => 1,
	'fuelId' => 10,
	'submodelId' => 100,
	'yearId' => 1000
);
$vehicle2 = array(
	'serialNumber' => 2,
	'modelId' => 1,
	'fuelId' => 10,
	'submodelId' => 100,
	'yearId' => 2000
);
$vehicle3 = array(
	'serialNumber' => 3,
	'modelId' => 1,
	'fuelId' => 10,
	'submodelId' => 200,
	'yearId' => 1000
);
$vehicle4 = array(
	'serialNumber' => 4,
	'modelId' => 1,
	'fuelId' => 10,
	'submodelId' => 200,
	'yearId' => 2000
);
$vehicle5 = array(
	'serialNumber' => 5,
	'modelId' => 1,
	'fuelId' => 20,
	'submodelId' => 100,
	'yearId' => 1000
);
$vehicle6 = array(
	'serialNumber' => 6,
	'modelId' => 1,
	'fuelId' => 20,
	'submodelId' => 100,
	'yearId' => 2000
);
$vehicle7 = array(
	'serialNumber' => 7,
	'modelId' => 1,
	'fuelId' => 20,
	'submodelId' => 200,
	'yearId' => 1000
);
$vehicle8 = array(
	'serialNumber' => 8,
	'modelId' => 1,
	'fuelId' => 20,
	'submodelId' => 200,
	'yearId' => 2000
);
$vehicle9 = array(
	'serialNumber' => 9,
	'modelId' => 2,
	'fuelId' => 20,
	'submodelId' => 200,
	'yearId' => 2000
);
$vehicles = array(
	'0' => $vehicle1,
	'1' => $vehicle2,
	'2' => $vehicle3,
	'3' => $vehicle4,
	'4' => $vehicle5,
	'5' => $vehicle6,
	'6' => $vehicle7,
	'7' => $vehicle8,
	'8' => $vehicle9
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
		$_SESSION['tempVehicle'] = $vehicle;	
		jsonResponse($vehicle);
	}else { 
		//Check if a vehicle was selected from the selection screen.
		$modelId = $_SESSION['tempModel'];
		$fuelId = $_SESSION['tempFuel'];
		$submodelId = $_SESSION['tempSubmodel'];
		$yearId = $_SESSION['tempYear'];
		$currentVehicle = '';
		$found = false;
		foreach($vehicles as &$curVehicle) {
			if (((($curVehicle['modelId'] == $modelId) && ($curVehicle['fuelId'] == $fuelId)) 
				&& ($curVehicle['submodelId'] == $submodelId)) && ($curVehicle['yearId'] == $yearId)){
					$currentVehicle = $curVehicle;	
					$found = true;
			}
		}
		unset($curVehicle);
		if ($found) {
			$_SESSION['tempSerialNumber'] = $currentVehicle['serialNumber'];
			//Find the name of each part of the vehicle
			$currentModel = '';
			$currentFuel = '';
			$currentSubmodel = '';
			$currentYear = '';
			//Get model
			foreach($models as &$curModel) {
				if ($curModel['id'] == $modelId){
					$currentModel = $curModel['name'];	
				}
			}
			unset($curModel);
			//Get fuel
			foreach($fuels as &$curFuel) {
				if ($curFuel['id'] == $fuelId){
					$currentFuel = $curFuel['name'];	
				}
			}
			unset($curFuel);
			//Get submodel
			foreach($submodels as &$curSubmodel) {
				if ($curSubmodel['id'] == $submodelId){
					$currentSubmodel = $curSubmodel['name'];	
				}
			}
			unset($curSubmodel);
			//Get year
			foreach($years as &$curYear) {
				if ($curYear['id'] == $yearId){
					$currentYear = $curYear['name'];	
				}
			}
			unset($curYear);
			$returnedVehicle = array(
				"found" => true,
				"model" => $currentModel,
				"fuel" => $currentFuel,
				"sub_model" => $currentSubmodel,
				"year" => $currentYear				
			);	
			$_SESSION['tempVehicle'] = $returnedVehicle;	
			jsonResponse($returnedVehicle);
		} else {
			jsonResponse("There was an error in the session.");
		}
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
	jsonResponse($models);
//Saves the model id from selectModel.js
} else if (strcasecmp($command, 'selectModelSave') == 0){
	$selectedModel = "";
	if (isset($_POST['model'])){
		$selectedModel = $_POST['model'];
	}
	$_SESSION['tempModel'] = $selectedModel;
	jsonResponse(true);
//Loads the fuels for the select fuel page
}else if (strcasecmp($command, 'selectFuelLoad') == 0){
	//This is sloppy but it will be nicer once its SQL
	$modelId = $_SESSION['tempModel'];
	$found1 = false;
	$found2 = false;
	foreach($vehicles as &$curVehicle) {
		if ($curVehicle['modelId'] == $modelId) {
			if ($curVehicle['fuelId'] == 10) {
				$found1 = true;
			} else if ($curVehicle['fuelId'] == 20) {
				$found2 = true;
			}
		}
	}
	unset($curVehicle);
	$returnedFuels = "";
	if ($found1) {
		$returnedFuels = $fuels;
	} else {
		$returnedFuels = array(
			'0' => $fuel2
		);
	}
	jsonResponse($returnedFuels);
//Saves the fuel id from selectFuel.js
} else if (strcasecmp($command, 'selectFuelSave') == 0){
	$selectedFuel = "";
	if (isset($_POST['fuel'])){
		$selectedFuel = $_POST['fuel'];
	}
	$_SESSION['tempFuel'] = $selectedFuel;
	jsonResponse(true);
//Loads the submodels for the select submodel page
}else if (strcasecmp($command, 'selectSubmodelLoad') == 0){
	//This is sloppy but it will be nicer once its SQL
	$modelId = $_SESSION['tempModel'];
	$fuelId = $_SESSION['tempFuel'];
	$found1 = false;
	$found2 = false;
	foreach($vehicles as &$curVehicle) {
		if (($curVehicle['modelId'] == $modelId) && ($curVehicle['fuelId'] == $fuelId)){
			if ($curVehicle['submodelId'] == 100) {
				$found1 = true;
			} else if ($curVehicle['submodelId'] == 200) {
				$found2 = true;
			}
		}
	}
	unset($curVehicle);
	$returnedSubmodels = "";
	if ($found1) {
		$returnedSubmodels = $submodels;
	} else {
		$returnedSubmodels = array(
			'0' => $submodel2
		);
	}
	jsonResponse($returnedSubmodels);
//Saves the submodel id from selectSubmodel.js
} else if (strcasecmp($command, 'selectSubmodelSave') == 0){
	$selectedSubmodel = "";
	if (isset($_POST['submodel'])){
		$selectedSubmodel = $_POST['submodel'];
	}
	$_SESSION['tempSubmodel'] = $selectedSubmodel;
	jsonResponse(true);
//Loads the years for the select year page
}else if (strcasecmp($command, 'selectYearLoad') == 0){
	//This is sloppy but it will be nicer once its SQL
	$modelId = $_SESSION['tempModel'];
	$fuelId = $_SESSION['tempFuel'];
	$submodelId = $_SESSION['tempSubmodel'];
	$found1 = false;
	$found2 = false;
	foreach($vehicles as &$curVehicle) {
		if ((($curVehicle['modelId'] == $modelId) && ($curVehicle['fuelId'] == $fuelId)) && ($curVehicle['submodelId'] == $submodelId)){
			if ($curVehicle['yearId'] == 1000) {
				$found1 = true;
			} else if ($curVehicle['yearId'] == 2000) {
				$found2 = true;
			}
		}
	}
	unset($curVehicle);
	$returnedYears = "";
	if ($found1) {
		$returnedYears = $years;
	} else {
		$returnedYears = array(
			'0' => $year2
		);
	}
	jsonResponse($returnedYears);
//Saves the year id from selectYear.js
} else if (strcasecmp($command, 'selectYearSave') == 0){
	$selectedYear = "";
	if (isset($_POST['year'])){
		$selectedYear = $_POST['year'];
	}
	$_SESSION['tempYear'] = $selectedYear;
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

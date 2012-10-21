<?php
session_start();
$command = "";
/* A list of all possible com values in the order they appear below
	login - Checks user name and password, saves user to session if successful
	serialsearch - Checks the serial number against known serial numbers and saves
		a match to session if successful
	vehicleResultsLoad - Loads the information of the vehicle about to be selected
	vehicleResultsCancel - Clears the info about the vehicle about to be selected
	vehicleResultsSessionSave - Saves the selected vehicle to the session for filtering
	partsFilterLoad - Loads the currently selected filter for the parts page
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
	partsSearch - Searchs for a part
	partCategoryLoad - Loads the part categories for the parts page
	partsSearchLoadResults - Loads the search results for the parts
	partsSearchSelectPart - Saves the part number to be viewed later
	partInfoLoad - Loads the part info for the partInfo page
	selectCategorySave - Saves the category from select part
	selectSubcategoryLoad - Loads the subcategories
	selectSubcategorySave - Saves the subcategory from select part
	vehicleResultsAccountSave - Saves the vehicle to the account
	accountVehicleRemove - Removes a vehicle from an account
	shoppingCartLoad - Loads the shopping cart for the current user
	addToCart - Adds an item to the shopping cart
	shoppingCartRemove - Removes item from shopping cart
	loadAccountInfo - Loads the account info for the update account page
	updateAccount - Updates the account info
 */

/* A list of all the session variables
	currentPartNumber - The part number the user wants to view
	currentSerialNumber - The serial number of the vehicle currently saved in
		the session for parts filtering
	currentVehicle - The info of the vehicle currently saved in
		the session for parts filtering
	partSearchQuery - The characters used to search for parts
	tempCategory - The category selected in select part
	tempSubcategory - The subcategory selected in select part
	tempFuel - The fuel selected in select vehicle
	tempModel - The model id selected in select vehicle
	tempSerialNumber - The serial number of the vehicle that needs to be confirmed
		on the final myVehicle page
	tempSubmodel - The submodel selected in select vehilce
	tempVehicle - The vehicle (with name strings) selected in select vehicle
	tempYear - The year selected in select vehicle.
	uid - The logged in user id	
	uname - The logged in username
	
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
if (strcasecmp($command, 'login') == 0) {
	$uname = "";
	$pword = "";
        $data = array();
	//Call the database
	if (isset($request['username']) && isset($request['password'])){
            $data['command'] = "authenticate";
	    $data['username'] = $request['username'];
            $data['password'] = $request['password'];
	}
        $output = do_post_request($data);
	//Decode response
	$response = json_decode($output, true);
	//Get data
	$account = $response['data'];
	//If login successful, save info to session
	if($account['auth']) {
		$_SESSION['uname'] = $account['userName'];	  	
    		$_SESSION['uid'] = $account['accountID'];
	}
	//Return the data array to the client as a json object
	jsonResponse($account);
//Loads info for the serial number search in myVehicle.js
}else if (strcasecmp($command, 'serialsearch') == 0){
	$serial = "";
	if (isset($request['serial'])){
		$serial = $request['serial'];	
	}
        $data = array();
	//Call the database
        $data['command'] = "serialsearch";
	$data['serialNumber'] = $serial;
        $output = do_post_request($data);
	//Decode response
	$response = json_decode($output, true);
	//Get data
	$vehicle = $response['data'];

	if (!empty($vehicle)) {
		$_SESSION['tempSerialNumber'] = $serial;
		jsonResponse($vehicle);
	} else {
		jsonResponse("There were no results.");
	}	
//Loads the info for vehicleResults.js
} else if (strcasecmp($command, 'vehicleResultsLoad') == 0){
	//Get the serial number from the session
	$serial = $_SESSION['tempSerialNumber'];
	$output = "";
	$data = array();
	//If the serial number is set, make a different db call than if its not
	if(!empty($serial)) {
		$data['command'] = "serialsearch";
		$data['serialNumber'] = $serial;
		$output = do_post_request($data);
	} else {
		$data['command'] = "selectVehicleResults";
		$data['model'] = $_SESSION['tempModel'];
		$data['fuel'] = $_SESSION['tempFuel'];
		$data['submodel'] = $_SESSION['tempSubmodel'];
		$data['year'] = $_SESSION['tempYear'];
		$output = do_post_request($data);
	}
	//Decode response
	$response = json_decode($output, true);
	//Get data
	$vehicle = $response['data'];
	if (!empty($vehicle)) {
 		$_SESSION['tempVehicle'] = $vehicle;
		$_SESSION['tempSerialNumber'] = $vehicle['serialNumber'];
		jsonResponse($vehicle);
	} else {
		jsonResponse("There was an error in the session $output" );
	}
//Cancels the vehicle results by removing the temp serial number
} else if (strcasecmp($command, 'vehicleResultsCancel') == 0){
	//Remove the temporary serial number
	unset($_SESSION['tempSerialNumber']);
	unset($_SESSION['tempModel']);
	unset($_SESSION['tempFuel']);
	unset($_SESSION['tempSubmodel']);
	unset($_SESSION['tempYear']);
	unset($_SESSION['tempVehicle']);	
	jsonResponse(true);
//Saves the selected vehicle to the session
} else if (strcasecmp($command, 'vehicleResultsSessionSave') == 0){
	$serialNumber = $_SESSION['tempSerialNumber'];	
	$vehicle = $_SESSION['tempVehicle'];	
	//Remove the temporary serial number
	unset($_SESSION['tempSerialNumber']);
	unset($_SESSION['tempModel']);
	unset($_SESSION['tempFuel']);
	unset($_SESSION['tempSubmodel']);
	unset($_SESSION['tempYear']);
	unset($_SESSION['tempVehicle']);	
	$_SESSION['currentSerialNumber'] = $serialNumber;
	$_SESSION['currentVehicle'] = $vehicle;	
	jsonResponse(true);
//Loads the filter for the parts page
} else if (strcasecmp($command, 'partsFilterLoad') == 0){
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
	unset($_SESSION['currentSerialNumber']);
	unset($_SESSION['currentVehicle']);
	jsonResponse(true);
//Loads the models for the select model page
}else if (strcasecmp($command, 'selectModelLoad') == 0){
	//Search the databases
	$data = array();
	$data['command'] = "selectModelLoad";
	$output = do_post_request($data);
	$response = json_decode($output, true);
	//Get data
	$models = $response['data'];
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
	jsonResponse(true);
//Loads the fuels for the select fuel page
}else if (strcasecmp($command, 'selectFuelLoad') == 0){
	//Get the model from the session
	$modelId = $_SESSION['tempModel'];
        $data = array();
	//Call the database
        $data['command'] = "selectFuelLoad";
	$data['model'] = $modelId;

        $output = do_post_request($data);

	$response = json_decode($output, true);
	//Get data
	$fuels = $response['data'];
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
        $data = array();
	//Call the database
        $data['command'] = "selectSubmodelLoad";
	$data['model'] = $modelId;
	$data['fuel'] = $fuelId;

        $output = do_post_request($data);

	$response = json_decode($output, true);
	//Get data
	$submodels = $response['data'];
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
	//Call the database
        $data['command'] = "selectYearLoad";
	$data['model'] = $modelId;
	$data['fuel'] = $fuelId;
	$data['submodel'] = $submodelId;

        $output = do_post_request($data);

	$response = json_decode($output, true);
	//Get data
	$years = $response['data'];
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
	unset($_SESSION['uname']);
	unset($_SESSION['uid']);
//Loads the vehicles for the current user
} else if (strcasecmp($command, 'accountVehiclesLoad') == 0) {
	$accountId = $_SESSION['uid'];
        $data = array();
	//Call the database
        $data['command'] = "accountVehiclesLoad";
	$data['account'] = $accountId;

        $output = do_post_request($data);

	$response = json_decode($output, true);
	//Get data
	$vehicles = $response['data'];
	if (!empty($vehicles)) {
		jsonResponse($vehicles);
	} else {
		jsonResponse("There are no vehicles for this account.");
	}
//Saves the selected vehicle to the session as a parts filter
} else if (strcasecmp($command, 'accountVehicleSessionSave') == 0){
	$serial = "";	
	if (isset($request['serialNumber'])){
		$serial = $request['serialNumber'];
	}
        $data = array();
	//Call the database
        $data['command'] = "serialsearch";
	$data['serialNumber'] = $serial;
        $output = do_post_request($data);
	//Decode response
	$response = json_decode($output, true);
	//Get data
	$vehicle = $response['data'];

	if (!empty($vehicle)) {
		$vehicle['found'] = true;
		$_SESSION['currentSerialNumber'] = $vehicle['serialNumber'];
		$_SESSION['currentVehicle'] = $vehicle;
		jsonResponse($vehicle);
	} else {
		jsonResponse("There were no results.");
	}	
//Searches the parts bases on a given string
} else if (strcasecmp($command, 'partsSearch') == 0) {
//Check for a vehicle filter
	$part = "";
	if (isset($request['part'])){
		$part = $request['part'];	
	}
        $data = array();
	//Call the database
        $data['command'] = "partsSearch";
	$data['query'] = $part;
        $output = do_post_request($data);
	//Decode response
	$response = json_decode($output, true);
	//Get data
	$vehicles = $response['data'];

	if (!empty($vehicles)) {
		$_SESSION['partSearchQuery'] = $part;
		jsonResponse(true);
	} else {
		jsonResponse("There were no results.");
	}	
//Loads the parts categories for the parts category page
} else if (strcasecmp($command, 'partCategoryLoad') == 0) {
	//Check for a vehicle filter
	$filter = $_SESSION['currentSerialNumber'];
	//Get the categories from the database
	$data = array();
	//Change query based on if there is a filter or not
	if (!empty($filter)) {	
		$data['command'] = "partCategoryLoadFilter";
		$data['filter'] = $filter;
	} else {
		$data['command'] = "partCategoryLoadAll";
	}
	$output = do_post_request($data);
	$response = json_decode($output, true);
	//Get data
	$categories = $response['data'];
	if (!empty($categories)) {
		jsonResponse($categories);
	} else {
		jsonResponse("No parts categories.");
	}
//Loads the part search results	
} else if (strcasecmp($command, 'partsSearchLoadResults') == 0) {
	$part = $_SESSION['partSearchQuery'];
	//If part is not empty, get search results.  Otherwise get select results	
	if (!empty($part)) {
		$data['command'] = "partsSearch";
		$data['query'] = $part;
	} else {
		$filter = $_SESSION['currentSerialNumber'];
		$subcategory = $_SESSION['tempSubcategory'];
		if(!empty($filter)) {
			$data['command'] = "selectPartResultsFiltered";
			$data['subcategory'] = $subcategory;	
			$data['filter'] = $filter;	
		} else {
			$data['command'] = "selectPartResultsAll";
			$data['subcategory'] = $subcategory;	
		}
	}
	$output = do_post_request($data);
	$response = json_decode($output, true);
	//Get data
	$parts = $response['data'];
	if (!empty($parts)) {
		jsonResponse($parts);
	} else {
		jsonResponse("No results.");
	}
//Saves the specific part for later loading
} else if (strcasecmp($command, 'partsSearchSelectPart') == 0) {
	$selectedPart = "";
	if (isset($request['part'])){
		$selectedPart = $request['part'];
	}
	$_SESSION['currentPartNumber'] = $selectedPart;
	//Clear the search filters
	$_SESSION['partSearchQuery'] = "";
	$_SESSION['tempSubcategory'] = "";
	$_SESSION['tempCategory'] = "";
	jsonResponse(true);
//Loads the part info for the part info results
} else if (strcasecmp($command, 'partInfoLoad') == 0) {
	//Get the part number from the session
	$part = $_SESSION['currentPartNumber'];
        $data = array();
	//Call the database
        $data['command'] = "partInfoLoad";
	$data['part'] = $part;
        $output = do_post_request($data);
	//Decode response
	$response = json_decode($output, true);
	//Get data
	$displayPart = $response['data'];

	if (!empty($displayPart)) {
		jsonResponse($displayPart);
	} else {
		jsonResponse("There was an error in the session.");
	}
//Saves the category to the session for future use
} else if (strcasecmp($command, 'selectCategorySave') == 0) {
	$selectedCategory = "";
	if (isset($request['category'])){
		$selectedCategory = $request['category'];
	}
	$_SESSION['partSearchQuery'] = "";
	$_SESSION['tempSubcategory'] = "";
	$_SESSION['tempCategory'] = $selectedCategory;
	jsonResponse(true);
//Loads the list of subcategories
} else if (strcasecmp($command, 'selectSubcategoryLoad') == 0) {
	//Check for a vehicle filter
	$filter = $_SESSION['currentSerialNumber'];
	$category = $_SESSION['tempCategory'];
	//Get the subategories from the database
	$data = array();
	//Change query based on if there is a filter or not
	if (!empty($filter)) {	
		$data['command'] = "partSubcategoryLoadFilter";
		$data['category'] = $category;
		$data['filter'] = $filter;
	} else {
		$data['command'] = "partSubcategoryLoadAll";
		$data['category'] = $category;
	}
	$output = do_post_request($data);
	$response = json_decode($output, true);
	//Get data
	$categories = $response['data'];
	if (!empty($categories)) {
		jsonResponse($categories);
	} else {
		jsonResponse("No parts categories.");
	}
//Saves the subcategory that was selected
} else if (strcasecmp($command, 'selectSubcategorySave') == 0) {
	$selectedSubcategory = "";
	if (isset($request['subcategory'])){
		$selectedSubcategory = $request['subcategory'];
	}
	$_SESSION['tempSubcategory'] = $selectedSubcategory;
	jsonResponse(true);
//Saves the vehicle to the account
} else if (strcasecmp($command, 'vehicleResultsAccountSave') == 0) {
	$accountId = $_SESSION['uid'];
	//Make sure the user is logged in.
	if (empty($accountId)) {
		jsonResponse("Login to save a vehicle to your account.");
	}
	$serialNumber = $_SESSION['tempSerialNumber'];	
	$vehicle = $_SESSION['tempVehicle'];	
	//Remove the temporary serial number
	unset($_SESSION['tempSerialNumber']);
	unset($_SESSION['tempModel']);
	unset($_SESSION['tempFuel']);
	unset($_SESSION['tempSubmodel']);
	unset($_SESSION['tempYear']);
	unset($_SESSION['tempVehicle']);	
	//Save to account
	$data = array();
	$data['command'] = "vehicleResultsAccountSave";
	$data['account'] = $accountId;
	$data['serial'] = $serialNumber;
	$output = do_post_request($data);
	jsonResponse(true);
//Removes vehicle from account
} else if (strcasecmp($command, 'accountVehicleRemove') == 0) {
	$accountId = $_SESSION['uid'];
	$serialNumber = "";
	//Make sure the user is logged in.
	if (isset($request['serial'])){
		$serialNumber = $request['serial'];
	}
	//Remove from account
	$data = array();
	$data['command'] = "accountVehicleRemove";
	$data['account'] = $accountId;
	$data['serial'] = $serialNumber;
	$output = do_post_request($data);
	jsonResponse(true);
//Load shopping cart
} else if (strcasecmp($command, 'shoppingCartLoad') == 0) {
	$accountId = $_SESSION['uid'];
        $data = array();
	//Call the database
        $data['command'] = "shoppingCartLoad";
	$data['account'] = $accountId;
        $output = do_post_request($data);
	//Decode response
	$response = json_decode($output, true);
	//Get data
	$displayPart = $response['data'];

	if (!empty($displayPart)) {
		jsonResponse($displayPart);
	} else {
		jsonResponse("There is nothing in your shopping cart");
	}
//Add part to shopping cart
} else if (strcasecmp($command, 'addToCart') == 0) {
	$accountId = $_SESSION['uid'];
	//Make sure the user is logged in.
	if (empty($accountId)) {
		jsonResponse("Login to use the shopping cart.");
	} else {
		$partNumber = $_SESSION['currentPartNumber'];	
		//Remove the temporary part number
		unset($_SESSION['currentPartNumber']);	
		//Save to account
		$data = array();
		$data['command'] = "addToCart";
		$data['account'] = $accountId;
		$data['part'] = $partNumber;
		$output = do_post_request($data);
		jsonResponse(true);
	}
//Remove part from shopping cart
} else if (strcasecmp($command, 'shoppingCartRemove') == 0) {
	$accountId = $_SESSION['uid'];
	$partNumber = "";
	if (isset($request['part'])){
		$partNumber = $request['part'];
	}
	$data = array();
	$data['command'] = "shoppingCartRemove";
	$data['account'] = $accountId;
	$data['part'] = $partNumber;
	$output = do_post_request($data);
	jsonResponse(true);
//Removes everything from shopping cart for checkout
} else if (strcasecmp($command, 'checkout') == 0) {
	$accountId = $_SESSION['uid'];
	$data = array();
	$data['command'] = "checkout";
	$data['account'] = $accountId;
	$output = do_post_request($data);
	jsonResponse(true);
//Loads the account info
} else if (strcasecmp($command, 'loadAccountInfo') == 0) {
	$accountId = $_SESSION['uid'];
        $data = array();
	//Call the database
        $data['command'] = "loadAccountInfo";
	$data['account'] = $accountId;
        $output = do_post_request($data);
	//Decode response
	$response = json_decode($output, true);
	//Get data
	$displayPart = $response['data'];

	if (!empty($displayPart)) {
		jsonResponse($displayPart);
	} else {
		jsonResponse("Couldn't load account information.");
	}
//Updates account info
} else if (strcasecmp($command, 'updateAccount') == 0) {
	$accountId = $_SESSION['uid'];
	$oldPassword = "";
	if (isset($request['oldPassword'])){
		$oldPassword = $request['oldPassword'];
	}
	$newPassword = "";
	if (isset($request['newPassword'])){
		$newPassword = $request['newPassword'];
	}
	$email = "";
	if (isset($request['email'])){
		$email = $request['email'];
	}
	$offers = "";
	if (isset($request['offers'])){
		$offers = $request['offers'];
	}
	$data = array();
	//Make sure old password is correct
            $data['command'] = "authenticate";
	    $data['username'] = $_SESSION['uname'];
            $data['password'] = $oldPassword;
        $output = do_post_request($data);
	//Decode response
	$response = json_decode($output, true);
	//Get data
	$account = $response['data'];
	//If login successful, update account information
	if($account['auth']) {
		$data = array();
		$data['email'] = $email;
		$data['offers'] = $offers;
		$data['account'] = $accountId;	
		//Only update password if its there
		if (!empty($newPassword)) {
		    $data['command'] = "updateAccountNewPassword";
		    $data['password'] = $newPassword;
		} else {
		    $data['command'] = "updateAccountSamePassword";
		}
		$output = do_post_request($data);
		jsonResponse(true);
	} else {
		jsonResponse("Current password did not match account password.");
	}
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
    
    // Build Http query using params
    $query = http_build_query ($params);
    
    // Create Http context details
    $contextData = array ( 
        'method' => 'POST',
        'header' => "Connection: close\r\n".
        "Content-Type: application/x-www-form-urlencoded\r\n".
        "Content-Length: ".strlen($query)."\r\n",
        'content'=> $query
    );

    // Create context resource for our request
    $context = stream_context_create (array ( 'http' => $contextData ));
    // Read page rendered as result of your POST request
    $result =  file_get_contents ($url, false, $context);
    
    return $result;
}
?>

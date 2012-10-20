<?php
session_start();
//mysql_connect('localhost','cs4911_team20','qqtgyu0O') or die( "Unable to connect");
//mysql_select_db('cs4911_team20') or die( "Unable to select database");
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
if (strcasecmp($command, 'login') == 0) {
	$uname = "";
	$pword = "";
        $data = array();
	if (isset($request['username']) && isset($request['password'])){
            $data['command'] = "authenticate";
	    $data['username'] = $request['username'];
            $data['password'] = $request['password'];
	}
        
        $output = do_post_request($data);
        return $output;/*
     	$uname = $request['username'];
     	$pword = $request['password'];
 	  	
	$query = "      SELECT  accountId,
				userName
			  FROM  Account
			 WHERE  userName = '$uname'
			   AND  password = '$pword'";
	$result = mysql_query ($query)  or die(mysql_error());
	//Return either the result or that there was no result
	if ($row = mysql_fetch_array($result)) {
    		$_SESSION['uname'] = $row['userName'];	  	
    		$_SESSION['uid'] = $row['accountId'];	  	
		jsonResponse(true);
	} else {
		jsonResponse("Username and password did not match.");
	}*/
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
				ON ylu.yearId = vt.yearId ";
	if (!empty($serial)){
		$query = $query . " WHERE vt.serialNumber = '$serial'";
	}else { 
		//Use a different query if picked from the select screens
		$modelId = $_SESSION['tempModel'];
		$fuelId = $_SESSION['tempFuel'];
		$submodelId = $_SESSION['tempSubmodel'];
		$yearId = $_SESSION['tempYear'];
		$query = $query .
			     "WHERE vt.modelId = '$modelId'
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
	unset($_SESSION['uname']);
	unset($_SESSION['uid']);
//Loads the vehicles for the current user
} else if (strcasecmp($command, 'accountVehiclesLoad') == 0) {
	$accountId = $_SESSION['uid'];
	//Search the databases
	$query = "          SELECT vt.serialNumber,
				   mlu.name as model,
				   flu.name as fuel,
				   slu.name as submodel,
				   ylu.name as year
			      FROM Account_Vehicle av
			INNER JOIN Vehicle_Type vt
				ON av.serialNumber = vt.serialNumber
			INNER JOIN Model_LU mlu
				ON mlu.modelId = vt.modelId
			INNER JOIN Fuel_LU flu
				ON flu.fuelId = vt.fuelId
			INNER JOIN Submodel_LU slu
				ON slu.submodelId = vt.submodelId
			INNER JOIN Year_LU ylu
				ON ylu.yearId = vt.yearId
			     WHERE av.accountId = '$accountId'";
	$result = mysql_query ($query)  or die(mysql_error());
	$vehicles = array();
	$i = 0;
	//Return all results or that there was no result
	while ($row = mysql_fetch_array($result)) {
		$vehicles[$i] = $row;
		$i = $i + 1;
	} 
	if (!empty($vehicles)) {
		jsonResponse($vehicles);
	} else {
		jsonResponse("There are no years matching this filter.");
	}
//Saves the selected vehicle to the session as a parts filter
} else if (strcasecmp($command, 'accountVehicleSessionSave') == 0){
	if (isset($request['serialNumber'])){
		$serialNumber = $request['serialNumber'];
	}
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
			     WHERE vt.serialNumber = '$serialNumber'";
	//Run the query
	$result = mysql_query ($query)  or die(mysql_error());
	//Return either the result or that there was no result
	if ($row = mysql_fetch_array($result)) {
		$row['found'] = true;
		$_SESSION['currentSerialNumber'] = $row['serialNumber'];
		$_SESSION['currentVehicle'] = $row;
		jsonResponse($row);
	} else {
		jsonResponse("There was an error in the session.");
	}
//Searches the parts bases on a given string
} else if (strcasecmp($command, 'partsSearch') == 0) {
//Check for a vehicle filter
	$part = "";
	if (isset($request['part'])){
		$part = $request['part'];	
	}
	//Search the database	
	$query = "
		SELECT Results.rank,
		       p.partNumber,
		       p.name,
		       p.price,
		       p.description,
		       pslu.name AS subcategoryName,
		       plu.name AS categoryName,
		       alu.name AS availability
		FROM(
		(
			SELECT 1 AS rank,
			       partNumber
			  FROM Part
			 WHERE partNumber = '$part'
		)
		UNION
		(
			SELECT 2 AS rank,
			       partNumber
			  FROM Part
			 WHERE UPPER(name) = UPPER('$part')
		)
		UNION
		(
			SELECT 3 AS rank,
			       partNumber
			  FROM Part
			 WHERE partNumber LIKE '$part%'
		)
		UNION
		(
			SELECT 4 AS rank,
			       partNumber
			  FROM Part
			 WHERE UPPER(name) LIKE UPPER('$part%')
		)
		UNION
		(
			SELECT 5 AS rank,
			       partNumber
			  FROM Part
			 WHERE partNumber LIKE '%$part%'
		)
		UNION
		(
			SELECT 6 AS rank,
			       partNumber
			  FROM Part
			 WHERE UPPER(name) LIKE UPPER('%$part%')
		)
		) AS Results
		INNER JOIN Part p
			ON p.partNumber = Results.partNumber
		INNER JOIN Part_Subcategory_LU pslu
			ON p.partSubcategoryId = pslu.subcategoryId
		INNER JOIN Part_Category_LU plu
			ON pslu.categoryId = plu.categoryId
		INNER JOIN Availability_LU alu
			ON p.availabilityId = alu.availabilityId
		  GROUP BY Results.partNumber
		    HAVING MIN(rank)
		  ORDER BY Results.rank ASC, Results.partNumber ASC";          
	$result = mysql_query ($query)  or die(mysql_error());
	//Save the search
	if ($row = mysql_fetch_array($result)) {
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
	$query = "  SELECT pclu.*
		      FROM Part_Category_LU pclu";
	if(!empty($filter)) {
		$query = $query . 
		       " INNER JOIN Part_Subcategory_LU pslu
				ON pclu.categoryId = pslu.categoryId
			INNER JOIN Part p
				ON p.partSubcategoryId = pslu.subcategoryId
			INNER JOIN Vehicle_Type_Part vtp
				ON vtp.partNumber = p.partNumber
			     WHERE vtp.serialNumber = '$filter'
			  GROUP BY pclu.categoryId";
	}
	$result = mysql_query ($query)  or die(mysql_error());
	$categories = array();
	$i = 0;
	//Return all results or that there was no result
	while ($row = mysql_fetch_array($result)) {
		$categories[$i] = $row;
		$i = $i + 1;
	} 
	if (!empty($categories)) {
		jsonResponse($categories);
	} else {
		jsonResponse("No parts categories.");
	}
//Loads the part search results	
} else if (strcasecmp($command, 'partsSearchLoadResults') == 0) {
	$part = $_SESSION['partSearchQuery'];
	//Search the database	
	if (!empty($part)) {
		$query = "
			SELECT Results.rank,
			       p.partNumber,
			       p.name,
			       p.price,
			       p.description,
			       pslu.name AS subcategoryName,
			       plu.name AS categoryName,
			       alu.name AS availability
			FROM(
			(
				SELECT 1 AS rank,
				       partNumber
				  FROM Part
				 WHERE partNumber = '$part'
			)
			UNION
			(
				SELECT 2 AS rank,
				       partNumber
				  FROM Part
				 WHERE UPPER(name) = UPPER('$part')
			)
			UNION
			(
				SELECT 3 AS rank,
				       partNumber
				  FROM Part
				 WHERE partNumber LIKE '$part%'
			)
			UNION
			(
				SELECT 4 AS rank,
				       partNumber
				  FROM Part
				 WHERE UPPER(name) LIKE UPPER('$part%')
			)
			UNION
			(
				SELECT 5 AS rank,
				       partNumber
				  FROM Part
				 WHERE partNumber LIKE '%$part%'
			)
			UNION
			(
				SELECT 6 AS rank,
				       partNumber
				  FROM Part
				 WHERE UPPER(name) LIKE UPPER('%$part%')
			)
			) AS Results
			INNER JOIN Part p
				ON p.partNumber = Results.partNumber
			INNER JOIN Part_Subcategory_LU pslu
				ON p.partSubcategoryId = pslu.subcategoryId
			INNER JOIN Part_Category_LU plu
				ON pslu.categoryId = plu.categoryId
			INNER JOIN Availability_LU alu
				ON p.availabilityId = alu.availabilityId
			  GROUP BY Results.partNumber
			    HAVING MIN(rank)
			  ORDER BY Results.rank ASC, Results.partNumber ASC";   
	} else {
		$filter = $_SESSION['currentSerialNumber'];
		$subcategory = $_SESSION['tempSubcategory'];
		$query = "  SELECT p.partNumber,
				   p.name,
				   p.price,
				   p.description,
				   pslu.name AS subcategoryName,
				   plu.name AS categoryName,
				   alu.name AS availability
			      FROM Part p";
		if (!empty($filter)) {
			$query = $query . " INNER JOIN Vehicle_Type_Part vtp
				ON p.partNumber = vtp.partNumber";
		}
			$query = $query . " INNER JOIN Part_Subcategory_LU pslu
				ON p.partSubcategoryId = pslu.subcategoryId
			INNER JOIN Part_Category_LU plu
				ON pslu.categoryId = plu.categoryId
			INNER JOIN Availability_LU alu
				ON p.availabilityId = alu.availabilityId
			     WHERE p.partSubcategoryId = '$subcategory'";

		if (!empty($filter)) {
			$query = $query . " AND vtp.serialNumber = '$filter'";
		}
	}       
	$result = mysql_query ($query)  or die(mysql_error());
	$parts = array();
	$i = 0;
	//Save the search
	while ($row = mysql_fetch_array($result)) {
		$parts[$i] = $row;
		$i = $i + 1;
	} 
	if (!empty($parts)) {
		jsonResponse($parts);
	} else {
		jsonResponse("There are no results. $query");
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
	$query = "          SELECT p.partNumber,
				   p.name,
				   p.price,
				   p.description,
				   pslu.name AS subcategoryName,
				   plu.name AS categoryName,
				   alu.name AS availability
			      FROM Part p
			INNER JOIN Part_Subcategory_LU pslu
				ON p.partSubcategoryId = pslu.subcategoryId
			INNER JOIN Part_Category_LU plu
				ON pslu.categoryId = plu.categoryId
			INNER JOIN Availability_LU alu
				ON p.availabilityId = alu.availabilityId
			     WHERE p.partNumber = '$part'"; 
	//Run the query
	$result = mysql_query ($query)  or die(mysql_error());
	//Return either the result or that there was no result
	if ($row = mysql_fetch_array($result)) {
		$row['found'] = true;
		jsonResponse($row);
	} else {
		jsonResponse("There was an error in the session.");
	}
//Saves the category to the session for future use
} else if (strcasecmp($command, 'selectCategorySave') == 0) {
	$selectedCategory = "";
	if (isset($request['category'])){
		$selectedCategory = $request['category'];
	}
	$_SESSION['tempCategory'] = $selectedCategory;
	jsonResponse(true);
//Loads the list of subcategories
} else if (strcasecmp($command, 'selectSubcategoryLoad') == 0) {
	//Check for a vehicle filter
	$filter = $_SESSION['currentSerialNumber'];
	$category = $_SESSION['tempCategory'];
	//Get the subcategories from the database
	$query = "SELECT pslu.subcategoryId,
                         pslu.name
                    FROM Part_Subcategory_LU pslu";
	if(!empty($filter)) {
		$query = $query . 
		      " INNER JOIN Part_Category_LU pclu
				ON pslu.categoryId = pclu.categoryId
			INNER JOIN Part p
				ON p.partSubcategoryId = pslu.subcategoryId
			INNER JOIN Vehicle_Type_Part vtp
				ON vtp.partNumber = p.partNumber";
	} 
	$query = $query . " WHERE pslu.categoryId = '$category'";
	if (!empty($filter)) {
		$query = $query . " AND vtp.serialNumber = '$filter'
			  GROUP BY pslu.subcategoryId";
	}
	$result = mysql_query ($query)  or die(mysql_error());
	$categories = array();
	$i = 0;
	//Return all results or that there was no result
	while ($row = mysql_fetch_array($result)) {
		$categories[$i] = $row;
		$i = $i + 1;
	} 
	if (!empty($categories)) {
		jsonResponse($categories);
	} else {
		jsonResponse("Error loading parts subcategories.");
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
	$query = " INSERT INTO Account_Vehicle (accountId, serialNumber)
     			VALUES ($accountId, $serialNumber)";
	$result = mysql_query ($query)  or die(mysql_error());
	jsonResponse(true);
//Removes vehicle from account
} else if (strcasecmp($command, 'accountVehicleRemove') == 0) {
	$accountId = $_SESSION['uid'];
	$serialNumber = "";
	//Make sure the user is logged in.
	if (isset($request['serial'])){
		$serialNumber = $request['serial'];
	}
	$query = "  DELETE FROM Account_Vehicle
			  WHERE accountId = '$accountId'
      			    AND serialNumber = '$serialNumber'
      			  LIMIT 1";
	$result = mysql_query ($query)  or die(mysql_error());
	jsonResponse(true);
//Load shopping cart
} else if (strcasecmp($command, 'shoppingCartLoad') == 0) {
	$accountId = $_SESSION['uid'];
	$query = "  SELECT p.partNumber,
			   p.name,
			   p.price,
			   p.description,
			   pslu.name AS subcategoryName,
			   plu.name AS categoryName,
			   alu.name AS availability
		      FROM Shopping_Cart sc
		INNER JOIN Part p
			ON sc.partNumber = p.partNumber
		INNER JOIN Part_Subcategory_LU pslu
			ON p.partSubcategoryId = pslu.subcategoryId
		INNER JOIN Part_Category_LU plu
			ON pslu.categoryId = plu.categoryId
		INNER JOIN Availability_LU alu
			ON p.availabilityId = alu.availabilityId
		     WHERE sc.accountId = '$accountId'";
	$result = mysql_query ($query)  or die(mysql_error());
	$items = array();
	$i = 0;
	//Return all results or that there was no result
	while ($row = mysql_fetch_array($result)) {
		$items[$i] = $row;
		$i = $i + 1;
	} 
	if (!empty($items)) {
		jsonResponse($items);
	} else {
		jsonResponse("Error loading parts subcategories.");
	}
//Add part to shopping cart
} else if (strcasecmp($command, 'addToCart') == 0) {
	$accountId = $_SESSION['uid'];
	//Make sure the user is logged in.
	if (empty($accountId)) {
		jsonResponse("Login to use the shopping cart.");
	}
	$partNumber = $_SESSION['currentPartNumber'];	
	//Remove the temporary serial number
	unset($_SESSION['currentPartNumber']);	
	//Save to account
	$query = " INSERT INTO Shopping_Cart (accountId, partNumber)
     			VALUES ($accountId, $partNumber)";
	$result = mysql_query ($query)  or die(mysql_error());
	jsonResponse(true);
//Remove part from shopping cart
} else if (strcasecmp($command, 'shoppingCartRemove') == 0) {
	$accountId = $_SESSION['uid'];
	$partNumber = "";
	if (isset($request['part'])){
		$partNumber = $request['part'];
	}
	$query = "  DELETE FROM Shopping_Cart
			  WHERE accountId = '$accountId'
      			    AND partNumber = '$partNumber'
      			  LIMIT 1";
	$result = mysql_query ($query)  or die(mysql_error());
	jsonResponse(true);
//Removes everything from shopping cart for checkout
} else if (strcasecmp($command, 'checkout') == 0) {
	$accountId = $_SESSION['uid'];
	$query = "  DELETE FROM Shopping_Cart
			  WHERE accountId = '$accountId'";
	$result = mysql_query ($query)  or die(mysql_error());
	jsonResponse(true);
//Loads the account info
} else if (strcasecmp($command, 'loadAccountInfo') == 0) {
	$accountId = $_SESSION['uid'];
	$query = "      SELECT email,
			       offers
			  FROM Account
			 WHERE accountId = '$accountId'";
	$result = mysql_query ($query)  or die(mysql_error());
	//Return either the result or that there was no result
	if ($row = mysql_fetch_array($result)) {
		jsonResponse($row);
	} else {
		jsonResponse("Couldn't load account information incorrect.");
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
	//Make sure old password is correct
	$query = "      SELECT *
			  FROM Account
			 WHERE accountId = '$accountId'
			   AND password = '$oldPassword'";
	$result = mysql_query ($query)  or die(mysql_error());
	//Make sure there was a result to check password
	if ($row = mysql_fetch_array($result)) {
		//Update info
		$query = "      UPDATE Account
				   SET email    = '$email',";
		if (!empty($newPassword)) {			       
			$query = $query . "password = '$newPassword',";
		}
		$query = $query . " offers   = '$offers'
				 WHERE accountId = '$accountId'";
		$result = mysql_query ($query)  or die(mysql_error());
		jsonResponse(true);
	} else {
		jsonResponse("Old password did not match account password.");
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
    
    echo $result;
    return;
}
?>

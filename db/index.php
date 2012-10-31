<?php
include 'db_helper.php';

$queries = parse_ini_file("sql.ini");
$request = "";

//Finds the type or the request (get or post)
switch($_SERVER['REQUEST_METHOD']){
    case 'GET': $request = &$_GET; break;
    case 'POST': $request = &$_POST; break;
    default: $request = &$_GET;
}

//runs the correct function based on a command
if (isset($request['com'])){
    $command = $request['com'];
    if(strcasecmp($command, 'authenticate') == 0){
        if (isset($request['username']) && isset($request['password'])){
            $username =  mysql_real_escape_string($request['username']);
            $password = mysql_real_escape_string($request['password']);
            authenticate($username, $password);
        }
    }else if (strcasecmp($command, 'findDealers') == 0){
	
	if (isset($request['lat']) && isset($request['lng']) && isset($request['zoom'])){
	    $lat = mysql_real_escape_string($request['lat']);
	    $lng = mysql_real_escape_string($request['lng']);
	    $zoom = mysql_real_escape_string($request['zoom']);
	    findDealers($lat, $lng, $zoom);
	}
    } else if(strcasecmp($command, 'serialsearch') == 0){
        if (isset($request['serialNumber'])) {
            serialSearch(mysql_real_escape_string($request['serialNumber']));
        }
    } else if(strcasecmp($command, 'selectVehicleResults') == 0){
        if (isset($request['model']) && isset($request['fuel']) && isset($request['submodel']) && isset($request['year'])) {
            $model = mysql_real_escape_string($request['model']);
            $fuel = mysql_real_escape_string($request['fuel']);
            $submodel = mysql_real_escape_string($request['submodel']);
            $year = mysql_real_escape_string($request['year']);
            selectVehicleResults($model, $fuel, $submodel, $year);
        }
    } else if(strcasecmp($command, 'selectModelLoad') == 0){
    	selectModelLoad();
    } else if(strcasecmp($command, 'selectFuelLoad') == 0){
	if(isset($request['model'])) {
            $model = mysql_real_escape_string($request['model']);
            selectFuelLoad($model);
	}
    } else if(strcasecmp($command, 'selectSubmodelLoad') == 0){
	if(isset($request['model']) && isset($request['fuel'])) {
            $model = mysql_real_escape_string($request['model']);
	    $fuel = mysql_real_escape_string($request['fuel']);
            selectSubmodelLoad($model, $fuel);
	}
    } else if(strcasecmp($command, 'selectYearLoad') == 0){
	if(isset($request['model']) && isset($request['fuel']) && isset($request['submodel'])) {
            $model = mysql_real_escape_string($request['model']);
	    $fuel = mysql_real_escape_string($request['fuel']);
	    $submodel = mysql_real_escape_string($request['submodel']);
            selectYearLoad($model, $fuel, $submodel);
	}
    } else if(strcasecmp($command, 'accountVehiclesLoad') == 0){
	if(isset($request['account'])) {
            $account = mysql_real_escape_string($request['account']);
	    accountVehiclesLoad($account);
	}
    } else if(strcasecmp($command, 'partsSearch') == 0){
	if(isset($request['query'])) {
            $search = mysql_real_escape_string($request['query']);
	    partsSearch($search);
	}
    } else if(strcasecmp($command, 'partCategoryLoadAll') == 0){
    	partCategoryLoadAll();
    } else if(strcasecmp($command, 'partCategoryLoadFilter') == 0){
	if(isset($request['filter'])) {
            $filter = mysql_real_escape_string($request['filter']);
	    partCategoryLoadFilter($filter);
	}
    } else if(strcasecmp($command, 'selectPartResultsAll') == 0){
	if(isset($request['subcategory'])) {
            $subcategory = mysql_real_escape_string($request['subcategory']);
	    selectPartResultsAll($subcategory);
	}
    } else if(strcasecmp($command, 'selectPartResultsFiltered') == 0){
	if(isset($request['subcategory']) && isset($request['filter'])) {
            $subcategory = mysql_real_escape_string($request['subcategory']);
            $filter = mysql_real_escape_string($request['filter']);
	    selectPartResultsFiltered($subcategory, $filter);
	}
    } else if(strcasecmp($command, 'partInfoLoad') == 0){
	if(isset($request['part'])) {
            $part = mysql_real_escape_string($request['part']);
	    partInfoLoad($part);
	}
    } else if(strcasecmp($command, 'partSubcategoryLoadAll') == 0){
	if(isset($request['category'])) {
            $category = mysql_real_escape_string($request['category']);
	    partSubcategoryLoadAll($category);
	}
    } else if(strcasecmp($command, 'partSubcategoryLoadFilter') == 0){
	if(isset($request['category']) && isset($request['filter'])) {
            $category = mysql_real_escape_string($request['category']);
            $filter = mysql_real_escape_string($request['filter']);
	    partSubcategoryLoadFilter($category, $filter);
	}
    } else if(strcasecmp($command, 'vehicleResultsAccountSave') == 0){
	if(isset($request['account']) && isset($request['serial'])) {
            $account = mysql_real_escape_string($request['account']);
            $serial = mysql_real_escape_string($request['serial']);
	    vehicleResultsAccountSave($account, $serial);
	}
    } else if(strcasecmp($command, 'accountVehicleRemove') == 0){
	if(isset($request['account']) && isset($request['serial'])) {
            $account = mysql_real_escape_string($request['account']);
            $serial = mysql_real_escape_string($request['serial']);
	    accountVehicleRemove($account, $serial);
	}
    } else if(strcasecmp($command, 'shoppingCartLoad') == 0){
	if(isset($request['account'])) {
            $account = mysql_real_escape_string($request['account']);
	    shoppingCartLoad($account);
	}
    } else if(strcasecmp($command, 'addToCart') == 0){
	if(isset($request['account']) && isset($request['part'])) {
            $account = mysql_real_escape_string($request['account']);
            $part = mysql_real_escape_string($request['part']);
	    addToCart($account, $part);
	}
    } else if(strcasecmp($command, 'shoppingCartRemove') == 0){
	if(isset($request['account']) && isset($request['part'])) {
            $account = mysql_real_escape_string($request['account']);
            $part = mysql_real_escape_string($request['part']);
	    shoppingCartRemove($account, $part);
	}
    } else if(strcasecmp($command, 'checkout') == 0){
	if(isset($request['account'])) {
            $account = mysql_real_escape_string($request['account']);
	    checkout($account);
	}
    } else if(strcasecmp($command, 'loadAccountInfo') == 0){
	if(isset($request['account'])) {
            $account = mysql_real_escape_string($request['account']);
	    loadAccountInfo($account);
	}
    } else if(strcasecmp($command, 'updateAccountSamePassword') == 0){
	if(isset($request['email']) && isset($request['offers']) && isset($request['account'])
           && isset($request['city']) && isset($request['state']) && isset($request['zip'])) {
            $address = mysql_real_escape_string($request['address']);
            $city = mysql_real_escape_string($request['city']);
            $state = mysql_real_escape_string($request['state']);
            $zip = mysql_real_escape_string($request['zip']);
            $email = mysql_real_escape_string($request['email']);
	    $offers = mysql_real_escape_string($request['offers']);
	    $account = mysql_real_escape_string($request['account']);
            updateAccountSamePassword($address, $city, $state, $zip, $email, $offers, $account);
	}
    } else if(strcasecmp($command, 'updateAccountNewPassword') == 0){
	if(isset($request['email']) && isset($request['oldPassword']) && isset($request['newPassword']) && isset($request['offers'])
           && isset($request['account']) && isset($request['city']) && isset($request['state']) && isset($request['zip'])) {
            $address = mysql_real_escape_string($request['address']);
            $city = mysql_real_escape_string($request['city']);
            $state = mysql_real_escape_string($request['state']);
            $zip = mysql_real_escape_string($request['zip']);
            $email = mysql_real_escape_string($request['email']);
	    $oldPassword = mysql_real_escape_string($request['oldPassword']);
	    $newPassword = mysql_real_escape_string($request['newPassword']);
	    $offers = mysql_real_escape_string($request['offers']);
	    $account = mysql_real_escape_string($request['account']);
            updateAccountNewPassword($address, $city, $state, $zip, $email, $oldPassword, $newPassword, $offers, $account);
	}
    } else if(strcasecmp($command, 'register') == 0){
        $uname; $pwd; $email; $address; $city; $state; $zip; $offers;
        if(isset($request['username'])){$uname=$request['username'];}
        if(isset($request['password'])){$pwd=$request['password'];}
        if(isset($request['email'])){$email=$request['email'];}
        if(isset($request['address'])){$address=$request['address'];}
        if(isset($request['city'])){$city=$request['city'];}
        if(isset($request['state'])){$state=$request['state'];}
        if(isset($request['zip'])){$zip=$request['zip'];}
        if(isset($request['offers'])){$offers=$request['offers'];}
        registerNewAccount($uname, $pwd, $email, $address, $city, $state, $zip, $offers);
    } else if (strcasecmp($command, 'retrieveVideos') == 0){
        retrieveVideos();
    }
} 

/*
 * authenticates a user based on the supplied username and password.
 * returns the account id if the user has been authenticated.
 */
function authenticate($uname, $pwd){
    global $queries;
    $dbQuery = $queries['authenticate'];
    $dbQuery = str_replace("/?1", $uname, $dbQuery);
    $dbQuery = str_replace("/?2" , $pwd, $dbQuery);
    
    $result = getDBResultRecord($dbQuery);
    $output = array("auth" => FALSE);  
    if (!$result) {
    }else {
        $output = array(
            "auth" => TRUE,
            "accountID" => $result['accountID'],
            "userName" => $result['userName']
            );
    }
    jsonResponse($output);
}

function findDealers($lat, $lng, $zoom){
    global $queries;
    $dbQuery = $queries['findDealers'];
    /*$dbQuery = str_replace("/?1", $lat, $dbQuery);
    $dbQuery = str_replace("/?2" , $lng, $dbQuery);
    $dbQuery = str_replace("/?3" , $zoom, $dbQuery);*/
    
    $result = getDBResultsArray($dbQuery);
    $output = array();  
    if (!$result) {
    }else {
	$i = 0;
	foreach($result as $row){
	    $out = array(
		"row" => $i,
		"id" => $row['id'],
		"name" => $row['name'],
		"address" => $row['address'],
		"city" => $row['city'],
		"state" => $row['state'],
		"zip" => $row['zip'],
		"phone" => $row['phone'],
		"lat" => $row['lat'],
		"lng" => $row['lng'],
		"url" => $row['url']
            );
	    $output[$i++] = $out;
	}
    }
    jsonResponse($output);
}

/*
 * Searches for a given serial number and returns a vehicle if it exists
 */
function serialSearch($serialNumber) {
	global $queries;
	$dbQuery = $queries['serialsearch'];
	$dbQuery = str_replace("/?1", $serialNumber, $dbQuery);
	    
	$result = getDBResultRecord($dbQuery);
	    
	if (!$result) {
		jsonResponse(false);
	} else {
		$result['found'] = true;
	    	jsonResponse($result);
	}
}

//Gets a vehicle using model, fuel, submodel, and year
function selectVehicleResults($model, $fuel, $submodel, $year) {
	global $queries;
	$dbQuery = $queries['selectVehicleResults'];
	$dbQuery = str_replace("/?1", $model, $dbQuery);
	$dbQuery = str_replace("/?2", $fuel, $dbQuery);
	$dbQuery = str_replace("/?3", $submodel, $dbQuery);
	$dbQuery = str_replace("/?4", $year, $dbQuery);
	    
	$result = getDBResultRecord($dbQuery);

	if (!$result) {
		jsonResponse(false);
	} else {
		$result['found'] = true;
	    	jsonResponse($result);
	}

}
//Gets the models
function selectModelLoad() {
	global $queries;
	$dbQuery = $queries['selectModelLoad'];
	$result = getDBResultsArray($dbQuery);
	    
	if (!$result) {
		jsonResponse(false);
	} else {
	    	jsonResponse($result);
	}
}

//Gets the fuels for a given model
function selectFuelLoad($model) {
	global $queries;
	$dbQuery = $queries['selectFuelLoad'];
	$dbQuery = str_replace("/?1", $model, $dbQuery);
	    
	$result = getDBResultsArray($dbQuery);
	    
	if (!$result) {
		jsonResponse(false);
	} else {
	    	jsonResponse($result);
	}
}

//Gets the submodels for a given model and fuel
function selectSubmodelLoad($model, $fuel) {
	global $queries;
	$dbQuery = $queries['selectSubmodelLoad'];
	$dbQuery = str_replace("/?1", $model, $dbQuery);
	$dbQuery = str_replace("/?2", $fuel, $dbQuery);
	    
	$result = getDBResultsArray($dbQuery);
	    
	if (!$result) {
		jsonResponse(false);
	} else {
	    	jsonResponse($result);
	}
}

//Gets the years for a given model, fuel, and submodel
function selectYearLoad($model, $fuel, $submodel) {
	global $queries;
	$dbQuery = $queries['selectYearLoad'];
	$dbQuery = str_replace("/?1", $model, $dbQuery);
	$dbQuery = str_replace("/?2", $fuel, $dbQuery);
	$dbQuery = str_replace("/?3", $submodel, $dbQuery);
	    
	$result = getDBResultsArray($dbQuery);
	    
	if (!$result) {
		jsonResponse(false);
	} else {
	    	jsonResponse($result);
	}
}

//Gets the vehicles saved to an account
function accountVehiclesLoad($account) {
	global $queries;
	$dbQuery = $queries['accountVehiclesLoad'];
	$dbQuery = str_replace("/?1", $account, $dbQuery);
	    
	$result = getDBResultsArray($dbQuery);
	    
	if (!$result) {
		jsonResponse(false);
	} else {
	    	jsonResponse($result);
	}
}

//Gets the vehicles saved to an account
function partsSearch($search) {
	global $queries;
	$dbQuery = $queries['partsSearch'];
	$dbQuery = str_replace("/?1", $search, $dbQuery);
	$dbQuery = str_replace("/?2", $search, $dbQuery);
	$dbQuery = str_replace("/?3", $search, $dbQuery);
	$dbQuery = str_replace("/?4", $search, $dbQuery);
	$dbQuery = str_replace("/?5", $search, $dbQuery);
	$dbQuery = str_replace("/?6", $search, $dbQuery);
	    
	$result = getDBResultsArray($dbQuery);
	    
	if (!$result) {
		jsonResponse(false);
	} else {
	    	jsonResponse($result);
	}
}

//Gets the part categories
function partCategoryLoadAll() {
	global $queries;
	$dbQuery = $queries['partCategoryLoadAll'];
	$result = getDBResultsArray($dbQuery);
	    
	if (!$result) {
		jsonResponse(false);
	} else {
	    	jsonResponse($result);
	}
}

//Gets the part categories using a filter
function partCategoryLoadFilter($filter) {
	global $queries;
	$dbQuery = $queries['partCategoryLoadFilter'];
	$dbQuery = str_replace("/?1", $filter, $dbQuery);
	$result = getDBResultsArray($dbQuery);
	    
	if (!$result) {
		jsonResponse(false);
	} else {
	    	jsonResponse($result);
	}
}

//Gets all the parts for a given subcateogry
function selectPartResultsAll($subcategory) {
	global $queries;
	$dbQuery = $queries['selectPartResultsAll'];
	$dbQuery = str_replace("/?1", $subcategory, $dbQuery);
	$result = getDBResultsArray($dbQuery);
	    
	if (!$result) {
		jsonResponse(false);
	} else {
	    	jsonResponse($result);
	}
}

//Gets all the parts for a given subcateogry with a vehicle filter
function selectPartResultsFiltered($subcategory, $filter) {
	global $queries;
	$dbQuery = $queries['selectPartResultsFiltered'];
	$dbQuery = str_replace("/?1", $subcategory, $dbQuery);
	$dbQuery = str_replace("/?2", $filter, $dbQuery);
	$result = getDBResultsArray($dbQuery);
	    
	if (!$result) {
		jsonResponse(false);
	} else {
	    	jsonResponse($result);
	}
}

//Loads the part info
function partInfoLoad($part) {
	global $queries;
	$dbQuery = $queries['partInfoLoad'];
	$dbQuery = str_replace("/?1", $part, $dbQuery);
	$result = getDBResultRecord($dbQuery);
	    
	if (!$result) {
		jsonResponse(false);
	} else {
	    	jsonResponse($result);
	}
}

//Loads every subcategory for the given category
function partSubcategoryLoadAll($category) {
	global $queries;
	$dbQuery = $queries['partSubcategoryLoadAll'];
	$dbQuery = str_replace("/?1", $category, $dbQuery);
	$result = getDBResultsArray($dbQuery);
	    
	if (!$result) {
		jsonResponse(false);
	} else {
	    	jsonResponse($result);
	}
}

//Loads every subcategory for the given category and filter
function partSubcategoryLoadFilter($category, $filter) {
	global $queries;
	$dbQuery = $queries['partSubcategoryLoadFilter'];
	$dbQuery = str_replace("/?1", $category, $dbQuery);
	$dbQuery = str_replace("/?2", $filter, $dbQuery);
	$result = getDBResultsArray($dbQuery);
	    
	if (!$result) {
		jsonResponse(false);
	} else {
	    	jsonResponse($result);
	}
}

//Adds a vehicle to the an account
function vehicleResultsAccountSave($account, $serial) {
	global $queries;
	$dbQuery = $queries['vehicleResultsAccountSave'];
	$dbQuery = str_replace("/?1", $account, $dbQuery);
	$dbQuery = str_replace("/?2", $serial, $dbQuery);
	$result = getDBResultInserted($dbQuery, "Inserted");
	jsonResponse($result);
}

//Removes vehicle from account
function accountVehicleRemove($account, $serial) {
	global $queries;
	$dbQuery = $queries['accountVehicleRemove'];
	$dbQuery = str_replace("/?1", $account, $dbQuery);
	$dbQuery = str_replace("/?2", $serial, $dbQuery);
	$result = getDBResultAffected($dbQuery);
	jsonResponse($result);
}

//Loads the shopping cart for an account
function shoppingCartLoad($account) {
	global $queries;
	$dbQuery = $queries['shoppingCartLoad'];
	$dbQuery = str_replace("/?1", $account, $dbQuery);
	$result = getDBResultsArray($dbQuery);
	    
	if (!$result) {
		jsonResponse(false);
	} else {
	    	jsonResponse($result);
	}
}

//Adds a part to the shopping cart
function addToCart($account, $part) {
	global $queries;
	$dbQuery = $queries['addToCart'];
	$dbQuery = str_replace("/?1", $account, $dbQuery);
	$dbQuery = str_replace("/?2", $part, $dbQuery);
	$result = getDBResultInserted($dbQuery, "Inserted");
	jsonResponse($result);
}

//Removes an item from the shopping cart
function shoppingCartRemove($account, $part) {
	global $queries;
	$dbQuery = $queries['shoppingCartRemove'];
	$dbQuery = str_replace("/?1", $account, $dbQuery);
	$dbQuery = str_replace("/?2", $part, $dbQuery);
	$result = getDBResultAffected($dbQuery);
	jsonResponse($result);
}

//Removes all items from the shopping cart
function checkout($account) {
	global $queries;
	$dbQuery = $queries['checkout'];
	$dbQuery = str_replace("/?1", $account, $dbQuery);
	$result = getDBResultAffected($dbQuery);
	jsonResponse($result);
}

//Loads account info
function loadAccountInfo($account) {
	global $queries;
	$dbQuery = $queries['loadAccountInfo'];
	$dbQuery = str_replace("/?1", $account, $dbQuery);
	$result = getDBResultRecord($dbQuery);
	if (!$result) {
		jsonResponse(false);
	} else {
	    	jsonResponse($result);
	}
}

//Updates email and offers for account
function updateAccountSamePassword($address, $city, $state, $zip, $email, $offers, $account) {
	global $queries;
	$dbQuery = $queries['updateAccountSamePassword'];
        $dbQuery = str_replace("/?1", $address, $dbQuery);
        $dbQuery = str_replace("/?2", $city, $dbQuery);
        $dbQuery = str_replace("/?3", $state, $dbQuery);
        $dbQuery = str_replace("/?4", $zip, $dbQuery);
	$dbQuery = str_replace("/?5", $email, $dbQuery);
	$dbQuery = str_replace("/?6", $offers, $dbQuery);
	$dbQuery = str_replace("/?7", $account, $dbQuery);
	$result = getDBResultAffected($dbQuery);
	jsonResponse($result);
}

//Updates email, offers and password for account
function updateAccountNewPassword($address, $city, $state, $zip, $email, $oldPassword, $newPassword, $offers, $account) {
	global $queries;
	$dbQuery = $queries['updateAccountNewPassword'];
        $dbQuery = str_replace("/?1", $address, $dbQuery);
        $dbQuery = str_replace("/?2", $city, $dbQuery);
        $dbQuery = str_replace("/?3", $state, $dbQuery);
        $dbQuery = str_replace("/?4", $zip, $dbQuery);
	$dbQuery = str_replace("/?5", $email, $dbQuery);
	$dbQuery = str_replace("/?6", $newPassword, $dbQuery);
	$dbQuery = str_replace("/?7", $offers, $dbQuery);
	$dbQuery = str_replace("/?8", $account, $dbQuery);
	$dbQuery = str_replace("/?9", $oldPassword, $dbQuery);
	$result = getDBResultAffected($dbQuery);
	jsonResponse($result);
}

//Registers a new user account
function registerNewAccount($uname, $pwd, $email, $address, $city, $state, $zip, $offers){
    global $queries;
    $dbQuery = $queries['register'];
    $dbQuery = str_replace("/?1", $uname, $dbQuery);
    $dbQuery = str_replace("/?2", $pwd, $dbQuery);
    $dbQuery = str_replace("/?3", $email, $dbQuery);
    $dbQuery = str_replace("/?4", $offers, $dbQuery);
    $dbQuery = str_replace("/?5", $address, $dbQuery);
    $dbQuery = str_replace("/?6", $city, $dbQuery);
    $dbQuery = str_replace("/?7", $state, $dbQuery);
    $dbQuery = str_replace("/?8", $zip, $dbQuery);
    $result = getDBResultInserted($dbQuery, "Inserted");
    
    if(strcasecmp($result['Inserted'], 'D') != 0){
        $dbQuery = $queries['authenticate'];
        $dbQuery = str_replace("/?1", $uname, $dbQuery);
        $dbQuery = str_replace("/?2" , $pwd, $dbQuery);
        
        $result = getDBResultRecord($dbQuery);
        $result = array(
                    "accountID" => $result['accountID'],
                    "userName" => $result['userName']
                    );
    }
    jsonResponse($result);
}

//Retrieves the list of videos from the Database
function retrieveVideos(){
    global $queries;
    $dbQuery = $queries['retrieveVideos'];
    $result = getDBResultsArray($dbQuery);
    
    $output = array();  
    if (!$result) {
    }else {
	$i = 0;
	foreach($result as $row){
	    $out = array(
                "Row" => $i,
                "ID" => $row['id'],
                "Title" => $row['Title'],
                "URL" => $row['URL'],
                "Image" => $row['Image'],
                "Category" => $row['Category']
                );
            $output[$i++] = $out;
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

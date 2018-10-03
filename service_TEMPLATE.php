<?php
/***
 * Rest service framework
 */

// Includes and defaults

include_once('app_config.php');
include_once('include/tools.php');

include_once('include/request.php');
include_once('include/database.php');
include_once('include/display.php');
///////////////////////////////
// INPUT
///////////////////////////////

// Process incoming values
$request_terms= new Request();

// Set the defined terms
$request_terms->set_default_parameter_array($defaults);
$request_terms->set_service_parameter_array($service_requests);

// find the service type from the url
$module_type=$request_terms->run_service_type($_SERVER['REDIRECT_URL'], URI_OFFSET);

// Past the $_GET array and process into an array
$request_terms->run_get($_GET);
////
check_empty_request($request_terms);
//  get the array - maybe better to pass bsck from run_get
$request_array = $request_terms->get_request_array();
/////
check_empty_request($request_array);
///////////////////////////////
// END INPUT
///////////////////////////////

///////////////////////////////
// DATABASE and QUERIES
///////////////////////////////

$database = new Database();
$database->getConnection();
$sql;

if (array_key_exists(SEARCH_TERM_ID, $request_array)){
    
    $database->set_query($base_sql);
    // $sql=$base_sql;
    $database->add_pdo(SEARCH_TERM_ID, $request_array[SEARCH_TERM_ID] );
    
    if (array_key_exists(GET_TERM_FORMAT, $request_array)){
        $database->append_to_query($format_sql);
        
        // $sql=$sql.$format_sql;
        $database->add_pdo(GET_TERM_FORMAT, $request_array[GET_TERM_FORMAT] );
    }
}


if (array_key_exists(DB_TERM_PROP, $request_array)){
    $database->set_query($base_sql_prop);
    // $sql=$base_sql_prop;
    $database->add_pdo(DB_TERM_PROP, "IODP-SSDB_".$request_array[DB_TERM_PROP] );
    
    if (array_key_exists(GET_TERM_FORMAT, $request_array)){
        $database->append_to_query($format_sql);
        //  $sql=$sql.$format_sql;
        $database->add_pdo(GET_TERM_FORMAT, $request_array[GET_TERM_FORMAT] );
    }
}


// $database->set_query($sql);
$database->stmt=$database->run_query_prepare();
$database->run_bind();


if ($database->stmt->execute()) {
    print_debug( "\nPDOStatement::errorCode(): ");
    print_debug ($database->stmt->errorCode());
    
} else {
    print_debug("<hr>Query failed!<hr>");
    
}


///////////////////////////////
// END DATABASE and QUERIES
///////////////////////////////


///////////////////////////////
// PRINT
///////////////////////////////

$query_results_arr=db_to_array($database->stmt, "SSDB file");

print_debug("<hr><hr>Print results:");
print_debug($query_results_arr);
print_debug($database->print_results($database->stmt));
print_debug("<hr><hr>");



///////////////////////////////
// TEST OUTPUT
///////////////////////////////

if (array_key_exists(GET_TERM_JSON, $request_array)){
    
    print_header(GET_TERM_JSON);
    print json_encode($query_results_arr);
    exit();
    
}

else
{
    $display_html= new Display();
    $display_html->html(json_encode($query_results_arr));
}







///////////////////////////////
// END PRINT
///////////////////////////////



//////////////////////////////
//////////////////////////////


?>
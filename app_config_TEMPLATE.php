<?php 
// SSDB 
// manage terms for app

define('URI_OFFSET', '0'); // 1 for twst server 0 for production
define('DEBUG', FALSE);

// Edit as needed
// Database
define("DATABASE_NAME", "data");
define("DATABASE_HOST", "localhost");
define("DATABASE_PORT", "5432");
define("DATABASE_USER", "person");
define("DATABASE_PW", "");
define("DB_CON","dbname=".DATABASE_NAME." user=".DATABASE_USER."  password=".DATABASE_PW."  host=".DATABASE_HOST." port=".DATABASE_PORT."");
define("DATABASE_VIEW", "db_view");

// Define GET and DB terms 
define("GET_TERM_ID", "id");
define("DB_TERM_FILE_ID", "file_id");

define("GET_TERM_PROP", "proposal");
define("DB_TERM_PROP", "collectionidentifier");
define("GET_TERM_FORMAT", "format");
//
define("GET_TERM_TYPE", "type");
define("GET_TERM_DEBUG", "debug");
define("GET_TERM_SITE", "site");

define("METHOD_TYPE_GET", "GET");
define("METHOD_TYPE_URL", "URL");


define("GET_TERM_JSON", "json");
define("GET_TERM_HTML", "html");
define("GET_TERM_USAGE", "usage");

define("SEARCH_TERM_ID", "file_id");
define("SEARCH_TERM_PROPOSAL", "proposal_id");

// 
// Define the GET terms
$service_requests = array();
$service_requests[GET_TERM_ID]= DB_TERM_FILE_ID;
$service_requests[GET_TERM_SITE]= GET_TERM_SITE;
$service_requests[GET_TERM_TYPE]= GET_TERM_TYPE;
$service_requests[GET_TERM_FORMAT]= GET_TERM_FORMAT;
$service_requests[GET_TERM_PROP]= DB_TERM_PROP;
$service_requests[GET_TERM_JSON]= GET_TERM_JSON;

// 
$defaults = array();
$defaults[GET_TERM_DEBUG]= GET_TERM_DEBUG;

/////////////////////////////////
// USAGE: 
define("USAGE_TERM_JSON", "Usage: ");
define("USAGE_TERM_JSON_QUERIES", "Allowed: id, proposal, id and format, proposal and format");
define("USAGE_TERM_JSON_EXAMPLES", "Ex: ?id=111112   Ex: ?proposal=P866&format=GIF");
$usage_term_json[0]= USAGE_TERM_JSON;
$usage_term_json[1]= USAGE_TERM_JSON_QUERIES;
$usage_term_json[2]= USAGE_TERM_JSON_EXAMPLES;


// SQL: 
$base_sql= "SELECT * FROM ".DATABASE_VIEW."  WHERE ".SEARCH_TERM_ID." = :" .SEARCH_TERM_ID;
$base_sql_prop = "SELECT * FROM ".DATABASE_VIEW."  WHERE ".DB_TERM_PROP." = :" .DB_TERM_PROP;
$format_sql= " AND ".GET_TERM_FORMAT." = :" .GET_TERM_FORMAT;


// WEBPAGE TERMS
define('WEBPAGE_TITLE', 'SSDB  data webservices');
define("WEBPAGE_DESCRIPTION", 'Tool to resolve SSDB data by id, proposal and format');

$html_header="<!DOCTYPE html>
<html lang=\"en\">
<head>
<meta charset=\"utf-8\">
<title>".WEBPAGE_TITLE."</title>
<meta name=\"description\" content=\"".WEBPAGE_DESCRIPTION."\" />
<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
</head>
<body>
";

//define("HEADER_LOGO", 'http://www.rvdata.us/files/r2rlogow.png');
define("HEADER_LOGO", 'https://ssdbdev2.iodp.org/images/head_logo_DEV.gif');
define("WEBPAGE_HTML_HEADER", $html_header);


?>
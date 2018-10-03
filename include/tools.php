<?php 

/////////////////////////////////
/////////////////////////////////

function init_array($id) {
    $query_results_arr=array();
    $query_results_arr[$id]=array();
    return $query_results_arr;
}


/////////////////////////////////
function db_to_array($stmt, $array_title) {
    
    $ct=0;
    $query_results_arr=init_array($array_title);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($query_results_arr[$array_title], $row);
        $ct=$ct+1;
        
    }    
    print_debug("<hr> Convert database results to array: <br> Query results ct =$ct <br>");   
    return $query_results_arr;
}

/////////////////////////////////
function build_table($array){
    // start table
    $html = '<br>';    
    // data rows
    foreach( $array as $value){        
        foreach( $value as $key=>$value2){
            $html .= '<table width=80% border=1>';
            
            foreach($value2 as $key2=>$value22){
                $html .= "<tr><td width=30% >&nbsp; $key2</td><td width=70% >&nbsp;" . htmlspecialchars($value22) . '</td></tr>';
            }            
            $html .= '</table><hr><br>';
        }
    }
    // finish table and return it    
    return $html;
}

/////////////////////////////////
function print_debug($text_string, $debug = NULL)
{
    if((DEBUG) || ($debug))
    {   //print_any("DEBUG: ");
        print_any($text_string);
    }
}

/////////////////////////////////
function print_any($text_string)
{
    if(is_array($text_string))
    {
        print "<pre>";
        print_r( $text_string);
        print "</pre>\n";
    }
    else
        print $text_string."\n";
}

/////////////////////////////////
function usage_json() {
     
    print_header('json');
    print json_encode(  array("message" => $usage_term_json));
    exit();
}

/////////////////////////////////
function nice_exit() {
    
    print_header('html');
    print $usage_term;
    exit();
}

/////////////////////////////////
function print_footer($type)
{
    
    $html_footer = "</head></html>";
    
    switch ($type) {
        case 'html':
            print $html_footer;
            break;


    }
    
}
/////////////////////////////////
function print_header($type)
{
        
    if(DEBUG) return;
    
    switch ($type) {
        case 'html':
            print WEBPAGE_HTML_HEADER;
            break;
        case 'json':
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            break;
        default:
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            break;
    }
    
}



///////////////////////////////

function check_empty_request($inarray)
{
    
    global $usage_term_json;
    $ct=count($inarray);
    if (!count($inarray))
    {
        print_any(json_encode($usage_term_json));
        exit();
    }
    
}



/////////////////////////////////


function view_php_info()
{
    
    $indicesServer = array('PHP_SELF',
        'argv',
        'argc',
        'GATEWAY_INTERFACE',
        'SERVER_ADDR',
        'SERVER_NAME',
        'SERVER_SOFTWARE',
        'SERVER_PROTOCOL',
        'REQUEST_METHOD',
        'REQUEST_TIME',
        'REQUEST_TIME_FLOAT',
        'QUERY_STRING',
        'DOCUMENT_ROOT',
        'HTTP_ACCEPT',
        'HTTP_ACCEPT_CHARSET',
        'HTTP_ACCEPT_ENCODING',
        'HTTP_ACCEPT_LANGUAGE',
        'HTTP_CONNECTION',
        'HTTP_HOST',
        'HTTP_REFERER',
        'HTTP_USER_AGENT',
        'HTTPS',
        'REMOTE_ADDR',
        'REMOTE_HOST',
        'REMOTE_PORT',
        'REMOTE_USER',
        'REDIRECT_REMOTE_USER',
        'SCRIPT_FILENAME',
        'SERVER_ADMIN',
        'SERVER_PORT',
        'SERVER_SIGNATURE',
        'PATH_TRANSLATED',
        'SCRIPT_NAME',
        'REQUEST_URI',
        'PHP_AUTH_DIGEST',
        'PHP_AUTH_USER',
        'PHP_AUTH_PW',
        'AUTH_TYPE',
        'PATH_INFO',
        'ORIG_PATH_INFO') ;
    
    echo '<table border=1 cellpadding="1">' ;
    foreach ($indicesServer as $arg) {
        if (isset($_SERVER[$arg])) {
            echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
        }
        else {
            echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ;
        }
    }
    echo '</table>' ;
    
}


?>
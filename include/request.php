<?php 
//include_once('config/global.php');
define('CLASS_DEBUG', DEBUG);

class Request{
    
    private $service_type;
    private $search_type;
    private $return_type;
    private $debug;
    private $service_array=array();
    private $global_default_parameters=array();
    private $global_service_parameters=array();
    
    /////////////////////////////////////////////
    public function __construct(){

        // Set default return type
        $this->return_type = GET_TERM_JSON;
        if(CLASS_DEBUG)print_any( "GET service request started: CONSTRUCT Class<br>");
            
    }
   
    /////////////////////////////////////////////
    // What service was call - from the url
    public function run_service_type($url_string, $offset = NULL){
       
        if($offset== NULL) $offset=1;
        $args = explode('/', $url_string); 
        $this->service_type=$args[$offset];              
        if(CLASS_DEBUG)print_debug("<hr>Search space: ".$this->service_type." (from ".$url_string." and offset = ".$offset.")<hr>");        
        return $this->service_type;
    }
    
    /////////////////////////////////////////////
    // If url then build the array
    public function run_url($url_string){
        
        $args = explode('/', $url_string);          
        $this->service_array=$this->url($url_string);       
        $this->set_if_single_term();                
        $this->search_type= $this->check_search_type();  
        
    }
        
    /////////////////////////////////////////////
    public function run_get($get_array){
        
        $in_array_ct=count($get_array);
        if(CLASS_DEBUG)print_any( "Incoming array: count incoming array = $in_array_ct<br>");
        if(CLASS_DEBUG)print_any($get_array);
        if(CLASS_DEBUG)print_any("<br>");
        if(CLASS_DEBUG)print_any( "Parameter list from app_config <hr>");
        
        foreach ($this->global_default_parameters as  $term => $value)
        {
            
            if (array_key_exists($term, $get_array)) $this->service_array[$term]=TRUE;
        }
        
        foreach ($this->global_service_parameters as  $term => $value)
        {
            if(CLASS_DEBUG)print_any("SERVICE PARAMETER: TERM: $term VALUE: $value <hr>");
            if (array_key_exists($term, $get_array)) $this->service_array[$value]=$get_array[$term];
            
        }
        
        if(CLASS_DEBUG)print_any( "Mapped output:<br>");
        if(CLASS_DEBUG)print_any($this->service_array);
            
        return $this->service_array;   
                
    }
 
    /////////////////////////////////////////////
    public function get_request_array(){
        return $this->service_array;
    }

    /////////////////////////////////////////////
    public function set_default_parameter_array($in_arr){       
        $this->global_default_parameters=$in_arr;
               
    }
 
    /////////////////////////////////////////////
    public function set_service_parameter_array($in_arr){
        $this->global_service_parameters=$in_arr;
        
    }
    
    /////////////////////////////////////////////
    private function check_search_type(){
        
      //  global $global_default_search_type;
        $return_val = NULL;
        // bounce back if empty
        if(empty($this->service_array)) return;
               
        foreach ($global_default_search_type as  $term => $value) {
            //print "TERM: $term  VALUE: $value<br>";
            if (array_key_exists($term, $this->service_array)) $return_val = $value;
        }
        return $return_val;
            
    }
    
    

    /////////////////////////////////////////////
    private function url($url_string, $offset){

        $data = array();
        $args = explode('/', $url_string);
        for ($i = $offset+1; $i < count($args); $i++) {
            $k = $args[$i];
            $v = ++$i < count($args) ? $args[$i] : null;
            $requests[$k]= $v;
            foreach ($this->global_default_parameters as  $term => $value) {
                if($k == $term) { $requests[$term]=TRUE; 
                //$this->return_type=TRUE; 
                }
            }
            
        }
        print_debug($requests);
        return $requests;
    }
    
    
    /////////////////////////////////////////////
    /////////////////////////////////////////////
    /////////////////////////////////////////////
    
    // FIX or verify or dump
    

    /////////////////////////////////////////////
    
    private function set_if_single_term(){
        
        if( count($this->service_array) == 1)
        {
            foreach ($this->service_array as $term => $value) {
                if($value==NULL)
                    $this->service_array[DB_TERM_FILE_ID] = $term;
            }           
        }
        
    }

    
    /////////////////////////////////////////////
    /////////////////////////////////////////////

    
   
    /////////////////////////////////////////////
    public function get_search_type() {
        return $this->search_type;
    }
    /////////////////////////////////////////////
    public function get_module_type() {
        return $this->service_type;
    }

    /////////////////////////////////////////////
    public function get_return_debug() {
        return $this->debug;
    }
    /////////////////////////////////////////////
    public function get_return_type() {
        return $this->return_type;
    }
    
    
    
}

?>
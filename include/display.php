<?php 


class Display{
    
    private $debug;
  
    /////////////////////////////////////////////
    public function __construct(){
            
    }
    
    public function html($json) {
                 
        $logo="<img src=".HEADER_LOGO."><br> ";       
        $data =  json_decode($json); 
               
        print_header(GET_TERM_HTML);
        print $logo;
        foreach ($data as $key => $value) {
            foreach ($value as $key2 => $value2) {
                print"<pre>";
                print_r($value2);
                print"</pre>";
                //$this->jsonToTable ($value);
            }

        }
        
        print_footer(GET_TERM_HTML);

    }
    
    
    
    
   //////////////////////////
   // hmmm 
    
    function jsonToTable ($data)
    {
        $table = '
    <table class="json-table" width="100%">
    ';
        foreach ($data as $key => $value) {
            $table .= '
        <tr valign="top">
        ';
            if ( ! is_numeric($key)) {
                $table .= '
            <td>
                <strong>'. $key .':</strong>
            </td>
            <td>
            ';
            } else {
                $table .= '
            <td colspan="2">
            ';
            }
            if (is_object($value) || is_array($value)) {
                $table .= jsonToTable($value);
            } else {
                $table .= $value;
            }
            $table .= '
            </td>
        </tr>
        ';
        }
        $table .= '
    </table>
    ';
        return $table;
    }
    
}
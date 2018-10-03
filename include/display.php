<?php

class Display{
    
    private $debug;
    
    /////////////////////////////////////////////
    public function __construct(){
        
    }
    
    /////////////////////////////////
    public function br() {
        print '<br />';
    }
    
    /////////////////////////////////
    public function logo() {
        print"<img src=".HEADER_LOGO.">";
        
    }
    
    /////////////////////////////////
    public function html($json) {
        
        $data =  json_decode($json);
        print $this->jsonToTable($data, TRUE);
        
    }
    
    /////////////////////////////////
    public function show_arrays($json) {
        
        $data =  json_decode($json);
        
        foreach ($data as $key => $value) {
            foreach ($value as $key2 => $value2) {
                
                print"<pre>";
                print_r($value2);
                print"</pre>";
                
            }
            
        }
        
    }
    
    
    /////////////////////////////////
    public function print_footer($type)
    {
        
        $html_footer = "</head></html>";
        
        switch ($type) {
            case 'html':
                print $html_footer;
                break;
                
                
        }
        
    }
    /////////////////////////////////
    public function print_html_header()
    {
        print WEBPAGE_HEADER;
        
    }
    
    /////////////////////////////////
    public function print_page_header()
    {
        print WEBPAGE_HTML_HEADER;
        
    }
    
    //////////////////////////
    // hmmm
    
    function jsonToTable($data, $outer = NULL)
    {
        
        
        $table = '<table class="json-table">';
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
                $table .= $this->jsonToTable($value);
                // $table .= print_r($value, TRUE);
            } else {
                $table .= $value;
            }
            $table .= '
            </td>
        </tr>
        ';
        }
        
        $table .= '</table>';
        if(!$outer)  $table .= '<hr>';
        
        return $table;
    }
    /////////////////////////////////
    
}
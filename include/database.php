<?php 

class Database{
    
    public $conn;   
    public $query;
    public $pdo_array;
    public $stmt;
    // get the database connection
    
   
    public function __construct(){
               
        print_debug( "<hr>Database service request started: CONSTRUCT Class<br>");
        
    }
    
    ///////////////////////////////////
    public function getConnection(){
        
        $this->conn = null;        
        try{           
            $dsn = "pgsql:host=".DATABASE_HOST.";port=".DATABASE_PORT.";dbname=".DATABASE_NAME.";user=".DATABASE_USER.";password=".DATABASE_PW;
            $this->conn = new PDO($dsn);
           // $this->conn->exec("set names utf8");
        }
        catch(PDOException $exception){
            print_debug( "DEBUG: Connection error: " . $exception->getMessage());
            echo "Sorry, our database if down for a moment. Please check back soon.";
            exit();
        }

    }
    ///////////////////////////////////
    public function set_query($query_in)
    {
        $this->query=$query_in;
    }
    
    ///////////////////////////////////
    public function append_to_query($query_in)
    {
        $this->query=$this->query.$query_in;
    }
    
    
    ///////////////////////////////////
    public function run_query_prepare()
    {
        print_debug ("<hr><hr><hr>SQL IN: <br>".$this->query." <br>");
        $this->stmt = $this->conn->prepare($this->query);
        return $this->stmt;
    }
    
    
    ///////////////////////////////////
    public function add_pdo($term, $value)
    {
        $this->pdo_array[$term] = $value;
        print_debug ("<hr> PDO TERM SET: [$term] = $value  ( WHERE :".$term." = '".$value."')<br>");
        
    }
    ///////////////////////////////////
    public function print_results ()
    {
        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)){
            print_r($row);
            
        }
    }
    ///////////////////////////////////
    
    ///////////////////////////////////
    public function run_bind()
    {
        if(!empty($this->pdo_array))
        {
            foreach ($this->pdo_array as $term => &$value) {
                print_debug ("<br> - $term  :: $value");
                $this->stmt->bindParam($term, $value, PDO::PARAM_STR);
            }
        }
        
    }
  
    ///////////////////////////////////
    public function run_query()
    {
        print_debug ("<hr>SQL IN: <br>".$this->query." <br>");
        $this->stmt = $this->conn->prepare($this->query);

        
        if(!empty($this->pdo_array))
        {
            foreach ($this->pdo_array as $term => $value) {
                print_debug ("<br> - $term  :: $value");
                /////
                $this->stmt->bindParam($term, $value, PDO::PARAM_STR);
            }
        }
                
        if ($this->stmt->execute()) {

        } else {
            print_debug("<hr>Query failed!<hr>");
        
        }
       
        print_debug ("<hr>PDO::errorInfo():\n<pre>");
        print_debug($this->conn->errorInfo());
        print_debug ("</pre>");
 
                
        return 
        ;  
 
    }

    
}





?>
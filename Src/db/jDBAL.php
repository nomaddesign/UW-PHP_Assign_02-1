<?php

namespace db;

use \PDO as PDO;

class jDBAL {
	
	private $hostname;
	private $database;
	private $username;
	private $password;
	private $rows;
	public $result;
	
	public function __construct($hostname, $username, $password, $database) {
		$this->hostname = $hostname;
		$this->database = $database;
		$this->username = $username;
		$this->password = $password;
	}
	
	// connect to the database
	public function connect(){     
	
		try {    
		
		  # MySQL with PDO_MYSQL  
		  $DBH = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password );  
		  
		  #Set Error Mode
		  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); 
		}  
		catch(PDOException $e) {  
		    echo $e->getMessage();  
		}  
	}
	
	public function query() {      // return the result of a select query. This function may return an array of rows, an array of models that represent the tables or rows.
	}
	
	public function update() {     // execute the update sql statement. It should throw an exception if the query fails to execute.
	}
	
	public function delete() {     // execute the delete sql statement. It should throw an exception if the query fails to execute.
	}
	
	public function insert() {     // execute insert sql statement. It should return last insert id if operation is successful, or throw an exception if the operation fails.
	}
	
	public function disconnect(){  // shutdowns established database connection
		# close the connection
		$DBH = null;
	}
	  
}
?>
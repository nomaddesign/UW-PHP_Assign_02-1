<?php

namespace db;

use \PDO as PDO;

class DbAccess extends PDO {
	
	private $hostname;
	private $database;
	private $username;
	private $password;
	private $db_engine;
	private	$db_file;
	private $rows;
	public $result;
	
	public function __construct($db_connect) {
		$this->db_engine = $db_connect['db_engine'];
		$this->db_file = $db_connect['db_file'];
		$this->hostname = $db_connect['hostname'];
		$this->database = $db_connect['database'];
		$this->username = $db_connect['username'];
		$this->password = $db_connect['password'];
	}
	
	// connect to the database
	public function connect(){
		try {
			if ($this->db_engine === 'mysql'){
				# MySQL with PDO_MYSQL  
				$this->dbh = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password );
			} 
			elseif ($this->db_engine === 'sqllite'){
				# SQLlite with PDO_SQLlite
				$this->dbh = new PDO('sqlite:assignment2.db');
			} 
			
			#Set Error Mode
			$this->dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
				
		} catch(\PDOException $e) {
		    die( 'Failed to establish database connection, error:'. $e->getMessage() );
		}// END Try/Catch	  
	}
	
	// return the result of a select query. This function may return an array of rows, an array of models that represent the tables or rows.
	public function select($query) {
		//SetUp Array for results
		$results = array();
		
		try {
			$statement = $this->dbh->prepare($query);//Build PDO Statement
			$statement->execute();//execute
			$statement->setFetchMode(PDO::FETCH_ASSOC); 
			//Loop through fetched rows
			while ($row = $statement->fetch()){
				array_push($results, $row);
			}
		} catch(\PDOExceptionn $e) {
		    die( 'Failed to select record(s):'. $e->getMessage() );
		}// END Try/Catch
		
		return $results; 
	}
	
	// execute the update sql statement. It should throw an exception if the query fails to execute.
	public function update($query) {
		try {
			$updateResult = $this->dbh->exec($query);
		} catch(\PDOException $e) {
		    die( 'Failed to update record:'. $e->getMessage() );
		}// END Try/Catch
		
		return $updateResult;
	}
	
	// execute the delete sql statement. It should throw an exception if the query fails to execute.
	public function delete($query) {
		try {
			$deleteResult = $this->dbh->exec($query);
		} catch(\PDOException $e) {
		    die( 'Failed to delete record:'. $e->getMessage() );
		}// END Try/Catch
		
		return $deleteResult; 
	}
	
	// execute insert sql statement. It should return last insert id if operation is successful, or throw an exception if the operation fails.
	public function insert($query) {
		try {
			$num = $this->dbh->exec($query);
			$insertResultID = $this->dbh->lastInsertId();
		} catch(\PDOException $e) {
	    	die( 'Failed to update record:'. $e->getMessage() );
		}// END Try/Catch
		
		return $insertResultID;
	}
	
	// shutdowns established database connection
	public function disconnect(){  
		# close the connection
		try {
			$this->dbh = null;
		} catch(\PDOException $e) {
		    die( 'Failed to close connection:'. $e->getMessage() );
		}
	}
	  
}
?>
<?php

namespace db;



$e = null;

error_reporting( E_ALL | E_STRICT );
ini_set('display_errors','On');
ini_set('display_startup_errors','On');

require_once ('../Bootstrap.php');

require_once ('db/jDBAL.php');

echo " Hello World";

$db = new jDBAL('127.0.0.1','assn2','mcdata','ci5ku6zu0show');

// connect to database, expect to
try {
    $db->connect();
} catch(\RuntimeException $e) {
    die( 'fails to establish database connection, error:'. $e->getMessage() );
    
}

echo $e;

//$db->disconnect();

$insertSql = "INSERT INTO User (firstname, lastname) VALUES ('Bob', 'Smith')";
$rowId = $db->insert($insertSql);

echo $rowId;

$id = array(5,7,9,11,13); 

$newRow = $db->select(sprintf("SELECT * FROM User WHERE id = %d", $rowId ));

\var_dump ($newRow);

// Should have at least one row
assert(count($newRow) > 0);




?>
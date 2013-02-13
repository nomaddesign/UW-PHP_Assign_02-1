<?php


$e = null;

error_reporting( E_ALL | E_STRICT );
ini_set('display_errors','On');
ini_set('display_startup_errors','On');

require_once ('../Bootstrap.php');

//require_once ('db/DbAccess.php');


$db = new db\DbAccess('127.0.0.1','assn2','mcdata','ci5ku6zu0show');

// connect to database
$db->connect();

//
$insertSql = "INSERT INTO User (firstname, lastname) VALUES ('Bob', 'Smith')";
$rowId = $db->insert($insertSql);

//
$newRow = $db->select(sprintf("SELECT * FROM User WHERE id = %d", $rowId ));

//Destruct DB Connection
$db->disconnect();

\var_dump ($newRow);

// Should have at least one row
assert(count($newRow) > 0);


?>
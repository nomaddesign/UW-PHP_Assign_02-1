<?php

use Db\Connection;

$db = new Connection( array(
                'host'     => 'localhost',
                'username' => 'foo',
                'password' => 'password',
                'dbname'   => 'mydatabase'
            ) );

// connect to database, expect to
try {
    $db->connect();
} catch(\RuntimeException $e) {
    die( 'fails to establish database connection, error:'. $e->getMessage() );
}

$insertSql = "'INSERT INTO Post (firstname, lastname) VALUES ('John', 'Smith')";
$rowId = $db->insert($insertSql);

$newRow = $db->select( sprintf("SELECT * FROM User WHERE id = %d", $rowId ) );

// Should have at least one row
assert(count($newRow) > 0);

?>
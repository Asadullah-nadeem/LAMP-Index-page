<?php
header('Content-Type: application/json');
/*
    AUTHOR: Asadullah Nadeem 
    VERSION: 1.0.0 
*/

// Database connection
$mysqli = new mysqli(
    'localhost',
    'root',
    '1234',
    ''
);

// Prepare response
$response = [
    'php_version' => phpversion(),
    'mysql_version' => $mysqli->server_info ?? 'N/A'
];

// Output JSON
echo json_encode($response);

$mysqli->close();

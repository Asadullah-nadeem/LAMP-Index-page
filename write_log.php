<?php
$logFile = 'logs.txt';
/*  
    AUTHOR: Asadullah Nadeem 
    VERSION: 1.0.0 
*/
// Simulate different types of logs for testing
$errorMessage = "Error at " . date('Y-m-d H:i:s') . ": Example error message\n";
$infoMessage = "Info at " . date('Y-m-d H:i:s') . ": Example informational message\n";

// Write log messages
file_put_contents($logFile, $errorMessage, FILE_APPEND);
file_put_contents($logFile, $infoMessage, FILE_APPEND);

// Confirm the log was written
echo "Logs written successfully!";

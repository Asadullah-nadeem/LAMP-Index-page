

<?php
/*
    AUTHOR: Asadullah Nadeem 
    VERSION: 1.0.0 
*/
$logFile = 'logs.txt';

if (file_exists($logFile)) {
  echo file_get_contents($logFile);
} else {
  echo "Error: Log file does not exist.";
}

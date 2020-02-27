<?php

define("HOST", "hostingautomation.database.windows.net");
define("USER", "kaique@hostingautomation");
define("PASSWORD", "root.0147");
define("DATABASE", "hosting");

function conectaAoMySQL()
{
    $serverName = "hostingautomation.database.windows.net"; // update me
    $connectionOptions = array(
        "Database" => "hosting", // update me
        "Uid" => "kaique@hostingautomation", // update me
        "PWD" => "root.0147" // update me
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    echo ("Reading data from table");

  return $conn;   
}

?>
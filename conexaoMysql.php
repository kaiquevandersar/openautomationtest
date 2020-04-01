<?php
$config = require 'SQL-auth.php';

define("HOST", $config['HOST']);
define("USER", $config['USER']);
define("PASSWORD", $config['PASSWORD']);
define("DATABASE", $config['DATABASE']);

function conectaAoMySQL()
{
  $conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
  if ($conn->connect_error)
    throw new Exception('Falha na conexão com o MySQL: ' . $conn->connect_error);

  return $conn;   
}

?>


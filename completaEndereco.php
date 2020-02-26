<?php

try
{
    require "conexaoMysql.php";
    $conn = conectaAoMySQL();

    $cep = $rua  = $bairro = "";

    if (isset($_POST["cep"]))
        $cep = $_POST["cep"];


    if (isset($_POST["rua"]))
        $rua = $_POST["rua"];


    if (isset($_POST["bairro"]))
        $bairro = $_POST["bairro"];

    echo "OK: Dados recebidos: $cep, $rua,  $bairro";
}
catch (Exception $e)
{
    $msgErro = $e->getMessage();
    echo $msgErro;
}

if ($conn != null)
    $conn->close();

?>
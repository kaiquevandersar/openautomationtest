<?php

class Endereco
{
    public $rua;
    public $cidade;
    public $bairro;
}

try
{
    require "../conexaoMysql.php";
    $conn = conectaAoMySQL();

    $cep = "";
    if (isset($_GET["cep"]))
        $cep = $_GET["cep"];

    $SQL = "
    SELECT logradouro, bairro, cidade
    FROM endereco
    WHERE cep = '$cep';
  ";

    if (! $result = $conn->query($SQL))
        throw new Exception('Ocorreu uma falha ao buscar o endereco: ' . $conn->error);

    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();

        $endereco = new Endereco();

        $endereco->rua    = $row["logradouro"];
        $endereco->bairro = $row["bairro"];
        $endereco->cidade = $row["cidade"];

        $jsonStr = json_encode($endereco);
        echo $jsonStr;
    }
}
catch (Exception $e)
{
    $msgErro = $e->getMessage();
}

if ($conn != null)
    $conn->close();

?>
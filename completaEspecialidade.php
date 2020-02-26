
<?php


try
{
    require "conexaoMysql.php";
    $conn = conectaAoMySQL();

//    $q = $_GET["q"];

    $SQL = "
    SELECT distinct especialidade
    FROM funcionario 
    WHERE especialidade is not NULL 
     ";

    $array = array();

    if (! $result = $conn->query($SQL))
        throw new Exception('Ocorreu uma falha ao buscar a especialidade ' . $conn->error);

    /*while(  $row = $result->fetch_assoc()) {
        $esp = new Especialidade();
        $esp->nome = $row["nome"];
        $array[] = $esp;
    }*/

    $array = $result->fetch_all(MYSQLI_ASSOC);

    $jsonStr = json_encode($array);
    echo $jsonStr;
}
catch (Exception $e)
{
    $msgErro = $e->getMessage();
}

if ($conn != null)
    $conn->close();
?>

<?php
session_start();
require "conexaoMysql.php";

function filtraEntrada($dado)
{
    $dado = trim($dado);               // remove espaços no inicio e no final da string
    $dado = stripslashes($dado);       // remove contra barras: "cobra d\'agua" vira "cobra d'agua"
    $dado = htmlspecialchars($dado);   // caracteres especiais do HTML (como < e >) são codificados

    return $dado;
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $msgErro = "";

    // Define e inicializa as variáveis
    $login = $pwd = "";

    $login = filtraEntrada($_POST['login']);
    $pwd = filtraEntrada($_POST['pwd']);

    try
    {
        $conn = conectaAoMySQL();

        $sql = "SELECT *
                FROM usuario
                WHERE login = '$login'
                AND senha = '$pwd'
        ";

        $result = $conn->query($sql);

        if (! $conn->query($sql))
            throw new Exception("Falha na autenticação dos dados: " . $conn->error);

        if($result->num_rows > 0) {
            $_SESSION['login'] = $login;
            $_SESSION['senha'] = $senha;
            header('location: arearestrita/listarContatos.php');
        }
        else{
            unset ($_SESSION['login']);
            unset ($_SESSION['senha']);
            echo "Acesso não permitido";
        }
    }
    catch (Exception $e)
    {
        $msgErro = $e->getMessage();
    }
}

?>
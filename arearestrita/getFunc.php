<?php

class Funcionario
{
    public $nome;
    public $sexo;
    public $cargo;
    public $rg;
    public $logradouro;
    public $cidade;
}

function getFunc($conn)
{
    $arrayF = "";

    $SQL = "
    SELECT nome, sexo,cargo,rg,logradouro,cidade
    FROM funcionario F , enderecofunc E
    WHERE F.codFuncionario = E.codFuncionario
  ";

    $result = $conn->query($SQL);
    if (! $result)
        throw new Exception('Ocorreu uma falha ao gerar o relatorio de testes: ' . $conn->error);

    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $funcionario = new Funcionario();


            $funcionario->nome          = $row["nome"];
            $funcionario->sexo          = $row["sexo"];
            $funcionario->cargo          = $row["cargo"];
            $funcionario->rg             = $row["rg"];
            $funcionario->logradouro       = $row["logradouro"];
            $funcionario->cidade          = $row["cidade"];


            $arrayF[] = $funcionario;
        }
    }

    return $arrayF;
}

?>
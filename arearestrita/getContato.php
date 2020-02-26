<?php

class Contato
{
    public $nome;
    public $email;
    public $assunto;
    public $mensagem;
}

function getContato($conn)
{
    $arrayC = "";

    $SQL = "
    SELECT *
    FROM contato
  ";

    $result = $conn->query($SQL);
    if (! $result)
        throw new Exception('Ocorreu uma falha ao gerar o relatorio de testes: ' . $conn->error);

    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $contato = new Contato();


            $contato->nome          = $row["nome"];
            $contato->email         = $row["email"];
            $contato->assunto   = $row["assunto"];
            $contato->mensagem  = $row["mensagem"];

            $arrayC[] = $contato;
        }
    }

    return $arrayC;
}

?>
<?php

class AgendF
{
    public $nome;
    public $especialidade;
    public $data;
    public $hora;
    public $nomePaciente;
    public $telefone;

}



function getAgend($conn)
{
    $arrayAF;

    $SQL = "
    SELECT F.nome, F.especialidade , A.hora , A.data, P.nome as nomep , P.telefone
    FROM funcionario F , agenda A , paciente P
    where F.codFuncionario = A.codFuncionario and A.codPaciente = P.codPaciente
     order by F.nome, A.data, A.hora ASC
  ";

    $result = $conn->query($SQL);
    if (! $result)
        throw new Exception('Ocorreu uma falha ao gerar o relatorio de testes: ' . $conn->error);

    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $agendF = new AgendF();



            $agendF->nome          = $row["nome"];
            $agendF->especialidade          = $row["especialidade"];
            $agendF->data          = $row["data"];
            $agendF->hora          = $row["hora"];
            $agendF->nomePaciente          = $row["nomep"];
            $agendF->telefone          = $row["telefone"];



            $arrayAF[] = $agendF;

        }
    }

    return $arrayAF;
}

?>

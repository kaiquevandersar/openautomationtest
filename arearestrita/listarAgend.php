<?php include "../includes/header2.php"; ?>

<?php

// Arquivo com os dados e função de conexão
require "../conexaoMysql.php";
require "getAgend.php";

$arrayA = "";
$msgErro = "";

try
{
    $conn = conectaAoMySQL();
    $arrayA = getAgend($conn);
}
catch (Exception $e)
{
    $msgErro = $e->getMessage();
}

?>


    <div class="container">


        <h3 class="text-primary">Agendamentos:</h3>

            <table id="tabelaAgend" class="table table-responsive table-striped " >
                <thead>
                <tr>

                    <th>Nome</th>
                    <th>Especialidade</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Nome Paciente</th>
                    <th>Telefone</th>

                </tr>
                </thead>

                <tbody>
                <?php

                if ($arrayA != "")
                {

                    foreach ($arrayA as $o)
                    {
                        echo "
                <tr>
                  <td>$o->nome</td>
                  <td>$o->especialidade</td>
                  <td>$o->data</td>
                  <td>$o->hora</td>      
                  <td>$o->nomePaciente</td>      
                  <td>$o->telefone</td>      
                  
                </tr>      
                ";
                    }
                }

                ?>



                </tbody>
            </table>

            <div class="container">
                <a class='btn btn-danger' role='button' onclick="fechaAtual() " >Atualizar</a>
            </div>


            <?php

            if ($msgErro != "")
                echo "<p class='text-danger'>A operação não pode ser realizada: $msgErro</p>";

            ?>



</div>






<?php include "../includes/footer.php"; ?>
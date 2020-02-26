<?php include "../includes/header2.php"; ?>

<?php

// Arquivo com os dados e função de conexão
require "../conexaoMysql.php";
require "getFunc.php";

$arrayF = "";
$msgErro = "";

try
{
    $conn = conectaAoMySQL();
    $arrayF = getFunc($conn);
}
catch (Exception $e)
{
    $msgErro = $e->getMessage();
}

?>

<div class="container">

    <h3 class="text-primary">Funcionarios:</h3>

    <table id="tabelaFunc" class="table table-striped table-responsive " >
        <thead>
        <tr>

            <th>Nome</th>
            <th>Sexo</th>
            <th>Cargo</th>
            <th>Rg</th>
            <th>Logradouro</th>
            <th>Cidade</th>

        </tr>
        </thead>

        <tbody>
        <?php

        if ($arrayF != "")
        {

            foreach ($arrayF as $o)
            {
                echo "
        <tr>
          <td>$o->nome</td>
          <td>$o->sexo</td>
          <td>$o->cargo</td>
          <td>$o->rg</td>      
          <td>$o->logradouro</td>      
          <td>$o->cidade</td>      
          
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
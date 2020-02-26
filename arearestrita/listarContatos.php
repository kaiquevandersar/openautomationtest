<?php include "../includes/header2.php"; ?>

<?php

// Arquivo com os dados e função de conexão
require "../conexaoMysql.php";
require "getContato.php";

$arrayContato = "";
$msgErro = "";

try
{
    $conn = conectaAoMySQL();
    $arrayContato = getContato($conn);
}
catch (Exception $e)
{
    $msgErro = $e->getMessage();
}

?>


    <div class="container">

        <h3 class="text-primary">Contato:</h3>

        <table id="tabelaContato" class="table table-responsive table-striped " >
            <thead>
            <tr>

                <th>Nome</th>
                <th>E-mail</th>
                <th>assunto</th>
                <th>Mensagem</th>

            </tr>
            </thead>

            <tbody>
            <?php

            if ($arrayContato != "")
            {

                foreach ($arrayContato as $c)
                {
                    echo "
        <tr>
          <td>$c->nome</td>
          <td>$c->email</td>
          <td>$c->assunto</td>
          <td>$c->mensagem</td>      
          
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
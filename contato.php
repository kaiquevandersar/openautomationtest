<?php
require "conexaoMysql.php";

function filtraEntrada($dado)
{
    $dado = trim($dado);               // remove espaços no inicio e no final da string
    $dado = stripslashes($dado);       // remove contra barras: "cobra d\'agua" vira "cobra d'agua"
    $dado = htmlspecialchars($dado);   // caracteres especiais do HTML (como < e >) são codificados

    return $dado;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $msgErro = "";

    // Define e inicializa as variáveis
    $nome = $email = $mensagem  = "";

    $nome             = filtraEntrada($_POST["nome"]);
    $email            = filtraEntrada($_POST["email"]);
    $assunto            = filtraEntrada($_POST["assunto"]);
    $mensagem         = filtraEntrada($_POST["mensagem"]);

    try {
        if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['assunto']) || empty($_POST['mensagem']))
            throw new Exception("Preencha todos os campos obrigatorios!");

        $conn = conectaAoMySQL();

        $sql = "
      INSERT INTO contato(id, nome, email,assunto, mensagem)
      VALUES (NULL, '$nome', '$email', '$assunto', '$mensagem');";

        if (!$conn->query($sql))
            throw new Exception("Falha na inserção dos dados: " . $conn->error);

        $formProcSucesso = true;
    } catch (Exception $e) {
        $msgErro = $e->getMessage();
    }
}

?>

<?php
include "includes/header.php";
?>


<section class="container-fluid" id="banner">
    <img class="img-responsive" src="img/contato.jpg">
</section>

<div class="container-fluid" id="conteudo">


    <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <div class="row paddingTopContact ">
        </div>

        <div class="row ">
            <div class="form-group">
                <div class="col-md-3 col-xs-1">
                </div>
                <div class="col-md-6 col-xs-10 formPagContactTop ">
                    <label for="nome">Nome:*</label>
                    <input type="nome" class="form-control " id="nome" name="nome" maxlength="50" required>
                </div>
                <div class="col-md-3 col-xs-1">
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="form-group">
                <div class="col-md-3 col-xs-1">
                </div>
                <div class="col-md-6 col-xs-10 formPagContact ">
                    <label for="email">Email:*</label>
                    <input type="email" class="form-control" id="email" name="email" maxlength="50" required>
                </div>
                <div class="col-md-3 col-xs-1">
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="form-group">
                <div class="col-md-3 col-xs-1">
                </div>
                <div class="col-md-6 col-xs-10 formPagContact ">
                    <label for="assunto">Assunto:*</label>
                    <select required id="assunto" name="assunto" class="form-control">
                        <option>Reclamação</option>
                        <option>Sugestão</option>
                        <option>Elogio</option>
                        <option>Duvida</option>
                    </select>
                </div>
                <div class="ccol-md-3 col-xs-1">
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="form-group">
                <div class="col-md-3 col-xs-1">
                </div>
                <div class="col-md-6 col-xs-10 formPagContact">
                    <label for="mensagem">Mensagem:*</label>
                    <textarea required class="form-control" rows="5" name="mensagem" id="mensagem" maxlength="700"></textarea>
                </div>
                <div class="col-md-3 col-xs-1">
                </div>

            </div>
        </div>

        <div class="row form-group ">
            <div class="col-md-3 col-xs-1">
            </div>
            <div class="col-md-6 col-xs-10 formPagContactBottom">
                <button type="submit" class="btn btn-default">Enviar</button>
            </div>
            <div class="col-md-3 col-xs-1">
            </div>
        </div>



    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($msgErro == "")
            echo "<h3 class='text-success centerText '>Dados enviados com sucesso!</h3>";
        else
            echo "<h3 class='text-danger centerText '>Erro, verifique os dados e tente novamente!</h3>";
    }
    ?>


    <div class="row paddingBottomContact">
    </div>


</div>

<?php
include "includes/footer.php";
?>
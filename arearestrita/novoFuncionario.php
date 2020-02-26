<?php include "../includes/header2.php"; ?>


<?php
require "../conexaoMysql.php";
?>
<?php
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
    $estado = $nome = $sexo = $data = $estadoCivil = $cargo = $especialidade = $cpf = $rg = $outro = $cep = $tipolog = $log = $numero = $complemento = $bairro = $cidade  = "";

    $nome             = filtraEntrada($_POST["nome"]);
    $sexo            = filtraEntrada($_POST["sexo"]);
    $data            = filtraEntrada($_POST["datanasc"]);
    $estadoCivil        = filtraEntrada($_POST["estcivil"]);
    $especialidade         = filtraEntrada($_POST["esp"]);
    $cargo        = filtraEntrada($_POST["cargo"]);
    $cpf        = filtraEntrada($_POST["cpf"]);
    $rg        = filtraEntrada($_POST["rg"]);
    $outro        = filtraEntrada($_POST["outro"]);
    $cep        = filtraEntrada($_POST["cep"]);
    $tipolog        = filtraEntrada($_POST["tipoLog"]);
    $log        = filtraEntrada($_POST["logradouro"]);
    $numero        = filtraEntrada($_POST["numero"]);
    $complemento        = filtraEntrada($_POST["complemento"]);
    $bairro        = filtraEntrada($_POST["bairro"]);
    $cidade        = filtraEntrada($_POST["cidade"]);
    $estado        = filtraEntrada($_POST["estado"]);

    try
    {
        $conn = conectaAoMySQL();



        $sql = "
                INSERT 
                INTO
                funcionario
                VALUES(NULL, '$nome','$data' ,'$sexo','$estadoCivil','$cargo','$especialidade','$cpf','$rg', '$outro'); 
                ";

        if (!$conn->query($sql))
            throw new Exception("Falha na inserção dos dados ".$conn-> error);



        $sql = "
            INSERT INTO enderecofunc
            values( NULL,'$cep','$log','$bairro','$cidade', '$estado', '$numero', '$tipolog', '$complemento', 
            (SELECT codFuncionario from funcionario where cpf = '$cpf') );
            
            ";

        if (!$conn->query($sql))
            throw new Exception("Falha na inserção dos dados ".$conn-> error);


        $formProcSucesso = true;
    }
    catch (Exception $e)
    {
        $msgErro = $e->getMessage();
    }
}

?>




<div class="paddingAgen ">

    <form class="form-group" id="myForm" name="myForm"   action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >

        <div class="form-group row">

            <div class="col-md-3">
            </div>

            <div class="col-md-6">
                <h4 class="text-primary">Dados Pessoais:</h4>
            </div>

            <div class="col-md-3">
            </div>
        </div>

        <div class=" form-group row">

            <div class="col-md-3">
            </div>

            <div class="col-md-6" >
                <label for="nome">Nome:*</label>
                <input type="text" id="nome" class="form-control" name="nome" maxlength="50" required>
            </div>

            <div class="col-md-3">
            </div>

        </div>


        <div class="form-group row">

            <div class="col-md-3">
            </div>

            <div class="col-md-2" >
<!--                                                //dar 6 e 10-->
                <label for="dataNasc">Data De Nascimento:*</label>
                <input type="date" id="datanasc" class="form-control" name="datanasc" required>
            </div>

            <div class="col-md-2" >
                <label for="dataNasc">Estado Civil*</label>
                <select type="" id="estcivil" class="form-control" name="estcivil" required>
                    <option value="s">Solteiro(a)</option>
                    <option value="c">Casado(a)</option>
                    <option value="d">Divorciado(a)</option>
                    <option value="v">Viuvo(a)</option>

                </select>
            </div>

            <div class="col-md-2" >
                <label class="radio form-group"><input type="radio" name="sexo" checked >Masculino</label>
                <label class="radio form-group"><input type="radio" name="sexo">Feminino</label>
            </div>



            <div class="col-md-3">
            </div>

        </div>




        <div class="form-group row">

            <div class="col-md-3">
            </div>

            <div class="col-md-3" >
                <label for="cargo">Cargo:*</label>
                <select  id="cargo" class="form-control" name="cargo" onchange=" verificaSmedico(this.value)" required>
                    <option value="Enfermeiro">Enfermeiro</option>
                    <option value="Medico">Médico</option>
                    <option value="Secretario">Secretário</option>
                    <option value="Outro">Outro</option>

                </select>


            </div>

            <div class="col-md-3" >

                <div id="espDiv">
                <label for="esp">Especialidade:*</label>
                <select  id="esp" class="form-control" name="esp" required>
                     <option > </option>
                    <option value="Cardiologia">Cardiologia</option>
                    <option value="Cirurgia Geral">Cirurgia Geral</option>


                </select>

                </div>

            </div>

            <div class="col-md-3">
            </div>
        </div>

        <div class="form-group row">

            <div class="col-md-3">
            </div>

            <div class="col-md-6">
                <h4 class="text-primary">Documentos:</h4>
            </div>

            <div class="col-md-3">
            </div>
        </div>

        <div class=" form-group row">

            <div class="col-md-3">
            </div>

            <div class="col-md-3" >
                <label for="cpf">CPF:*</label>
                <input type="text " id="cpf" class="form-control" name="cpf" maxlength="11" required>
            </div>

            <div class="col-md-3" >
                <label for="rg">RG:*</label>
                <input type="text" id="rg" class="form-control" name="rg" maxlength="20" required>
            </div>

            <div class="col-md-3">
            </div>

        </div>

        <div class=" form-group row">

            <div class="col-md-3">
            </div>

            <div class="col-md-6" >
                <label for="outro">Outro:*</label>
                <input type="text" id="outro" class="form-control" name="outro" maxlength="20" required>
            </div>

            <div class="col-md-3">
            </div>

        </div>

        <div class="form-group row">

            <div class="col-md-3">
            </div>

            <div class="col-md-6">
                <h4 class="text-primary">Endereço:</h4>
            </div>

            <div class="col-md-3">
            </div>
        </div>


        <div class=" form-group row">

            <div class="col-md-3">
            </div>

            <div class="col-md-2" >
                <label for="cep">CEP:*</label>
                <input type="text" id="cep" class="form-control" name="cep" maxlength="11" onkeyup="buscaEndereco(this.value)" required>
            </div>

            <div class="col-md-2" >
                <label for="tipoLog">Tipo de Logradouro:*</label>
                <input type="text" id="tipoLog" class="form-control" name="tipoLog" maxlength="10" required>
            </div>

            <div class="col-md-2" >
                <label for="numero">Numero:*</label>
                <input type="number" id="numero" class="form-control" name="numero"  required>
            </div>

            <div class="col-md-3">
            </div>

        </div>

        <div class="form-group row">

            <div class="col-md-3">
            </div>

            <div class="col-md-4">
                <label for="logradouro">Logradouro:*</label>
                <input type="text" id="logradouro" class="form-control" name="logradouro" maxlength="50" required>
            </div>

            <div class="col-md-2">
                <label for="bairro">Bairro:*</label>
                <input type="text" id="bairro" class="form-control" name="bairro" maxlength="40" required>
            </div>

            <div class="col-md-3">
            </div>
        </div>


        <div class="form-group row">

            <div class="col-md-3">
            </div>

            <div class="col-md-6">
                <label for="completo">Complemento:*</label>
                <input type="text" id="complemento" class="form-control" name="complemento" maxlength="20" required>
            </div>

            <div class="col-md-3">
            </div>
        </div>




        <div class="form-group row">

            <div class="col-md-3">
            </div>

            <div class="col-md-3">
                <label for="cidade">Cidade:*</label>
                <input type="text" id="cidade" class="form-control" name="cidade" maxlength="25" required>
            </div>

            <div class="col-md-3">
                <label for="estado">Estado:*</label>
                <input type="text" id="estado" class="form-control" name="estado" maxlength="2" required>
            </div>

            <div class="col-md-3">
            </div>
        </div>



        <div class="row form-group ">
            <div class="col-md-3">
            </div>
            <div class="col-md-6" >
                <button id="submit" name="submit" type="submit" class="btn btn-primary" >Enviar</button>
            </div>
            <div class="col-md-3">
            </div>
        </div>


        <!--            <input class="btn btn-primary" id="enviaForm" type="button" value="Enviar" onclick="enviaFormAjax()">-->




    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ($msgErro == ""){
            $showDivFlag = false;
            echo "<h3 class='text-success centerText '>Agendamento realizado com sucesso!</h3>";}
        else
            echo "<h3 class='text-danger centerText  '>Erro, verifique os dados e tente novamente!</h3>";
    }
    ?>

</div>


<?php include "../includes/footer.php"; ?>
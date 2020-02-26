<?php
require "conexaoMysql.php";
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
        $nome = $telefone = $data = $medico = $especialidade = $horario  = "";

        $nome             = filtraEntrada($_POST["nome"]);
        $telefone            = filtraEntrada($_POST["telefone"]);
        $data            = filtraEntrada($_POST["data"]);
        $medico         = filtraEntrada($_POST["medico"]);
        $especialidade         = filtraEntrada($_POST["especialidade"]);
        $horario         = filtraEntrada($_POST["horario"]);

        try
        {


            $conn = conectaAoMySQL();


            $conn->begin_transaction();
            if($horario==0)
                throw new Exception("Falha na inserção dos dados, hora invalida ");

                $sql = "
                INSERT 
                INTO
                paciente(codPaciente, nome, telefone)
                VALUES(NULL, '$nome', '$telefone'); 
                ";

               $x = $conn->query($sql);



            $sql = "
            INSERT INTO agenda(codAgendamento, data, hora, codFuncionario, codPaciente)
            VALUES (NULL, '$data', '$horario', 
            (SELECT codFuncionario            FROM funcionario            where nome = '$medico')
            ,
            (SELECT codPaciente            FROM paciente            where nome = '$nome')
            
            );
            ";

            if (!$conn->query($sql))
                throw new Exception("Falha na inserção dos dados ".$conn-> error);

            $conn->commit();
            $formProcSucesso = true;
        }
        catch (Exception $e)
        {
            $conn->rollback();
            $msgErro = $e->getMessage();
        }
    }

    ?>


<section class="cabecalho">
    <?php include "includes/header.php"; ?>
</section>

<section class="container-fluid" id="banner">
    <img class="img-responsive" src="img/agendamento.jpg">
</section>

<div class="container-fluid" id="conteudo" ">

    <div class="paddingAgen ">

        <form class="form-group" id="myForm" name="myForm"   action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
            <div class=" form-group row">

                <div class="col-md-3">
                </div>

                <div class="col-md-6" >
                    <label for="nome">Nome Completo:*</label>
                    <input type="text" id="nome" class="form-control" name="nome" maxlength="50" required>
                </div>

                <div class="col-md-3">
                </div>

            </div>


            <div class="form-group row">

                <div class="col-md-3">
                </div>

                <div class="col-md-6" >
                    <label for="telefone">Telefone:*</label>
                    <input type="text" id="telefone" class="form-control" name="telefone" maxlength="20" required>
                </div>

                <div class="col-md-3">
                </div>

            </div>




            <div class="form-group row">

                <div class="col-md-3">
                </div>

                <div class="col-md-6" >
                    <label for="especialidade">Especialidade:*</label>
                    <select id="especialidade" class="form-control" name="especialidade" onchange="completa()"  required>
                        <option selected value="0">Selecione uma especialidade</option>

                        <!--<option >Alergia</option>
                        <option value="cardiologista">Cardiologia</option>
                        <option >Pediatria</option>
                        <option>Cirurgia Geral</option>-->

                    </select>

                </div>

                <div class="col-md-3">
                </div>

            </div>

            <p id="teste"></p>


            <div class=" form-group row">

                <div class="col-md-3">
                </div>

                <div class="col-md-6" >
                    <label for="medico">Medico:*</label>
                    <select id="medico" class="form-control" name="medico" onchange="ativaHora()" disabled required >
                        <option value="0">Selecione um medico</option>



                    </select>
                </div>

                <div class="col-md-3">
                </div>

            </div>

            <div class=" form-group row">

                <div class="col-md-3">
                </div>

                <div class="col-md-3" >


                    <label for="data">Data da Consulta:*   </label>
                    <input type="date" id="data" class="form-control" name="data" min="2017-11-10"  onchange="ativaHora()" required>
                </div>
                <div class="col-md-3" >
                    <label for="horario">Horario da Consulta:*</label>
                    <select name="horario" id="horario" class="form-control" required disabled >
                        <option id="h0" value="0" name="h0">Selecione um horario</option>
                        <option id="8" value="8" name="8">8:00</option>
                        <option id="9" value="9" name="9">9:00</option>
                        <option id="10" value="10" name="10">10:00</option>
                        <option id="11" value="11" name="11">11:00</option>
                        <option id="12" value="12" name="12">12:00</option>
                        <option id="13" value="13" name="13">13:00</option>
                        <option id="14" value="14" name="14">14:00</option>
                        <option id="15" value="15" name="15">15:00</option>
                        <option id="16" value="16" name="16">16:00</option>
                        <option id="17" value="17" name="17">17:00</option>
                    </select>
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
</div>

<?php include "includes/footer.php"; ?>

$(document).ready(function(){
    $(".texto-missao, .texto-valores").fadeOut();
});

 $(document).ready(function() {
            $(".imgGalery").each(function(i) {
                $(this).delay(700*i).fadeIn();
            });
});
 
 function ativaborda(img){
	img.style.borderColor = 'red';
	img.style.borderWidth = '5px';
	img.style.borderStyle = 'solid';
}

function desativaborda(img){
	img.style.borderStyle = 'none';
}


$(document).ready(function () {
    $(".missao img").click(function () {
        $(this).fadeTo("slow", 0.10);
        $(".texto-missao").fadeToggle(500);
    });
});

$(document).ready(function () {
    $(".texto-missao").click(function () {
        $(".missao img").fadeTo("slow", 1.0);
        $(".texto-missao").fadeToggle(500);
    });
});

$(document).ready(function () {
    $(".valores img").click(function () {
        $(this).fadeTo("slow", 0.10);
        $(".texto-valores").fadeToggle(500);
    });
});

$(document).ready(function () {
    $(".texto-valores").click(function () {
        $(".valores img").fadeTo("slow", 1.0);
        $(".texto-valores").fadeToggle(500);
    });
});

function showMessageError()
{
    $("#divErrorMsg").stop().fadeIn(200).delay(2500).fadeOut(200);
}

function showMessageSuccess()
{
    $("#divSuccessMsg").stop().fadeIn(200).delay(2500).fadeOut(200);
}

$(document).ready(function(){
        // $('#especialidade').children('option:not(:first)').remove();
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {

                    // document.getElementById("teste").innerHTML = "success ajax: " + xhttp.responseText;

                    //var nome = xhttp.responseText ;
                    var nome = JSON.parse(xhttp.responseText);

                    for (pos in nome) {
                        texto = nome[pos].especialidade;
                        var campoSelect = document.getElementById("especialidade");
                        var option = document.createElement("option");
                        option.text = texto;
                        option.value = texto;
                        campoSelect.add(option);

                    }

                   // $("#medico").prop("disabled", false);
                    //  document.getElementById("teste").innerHTML = "success ajax final -: " + texto;
                    // document.getElementById("textoSugestao").innerHTML = xhttp.responseText;
                }
            }

            xhttp.open("GET", "completaEspecialidade.php", true);
            //document.getElementById("teste").innerHTML = "especialidade dento ajax: " + especialidade;
            xhttp.send();

    dataHoje();

});

$(document).ready(function(){

    var hj = new Date();
    var dd = hj.getDate();
    var mm = hj.getMonth() + 1; //Janeiro é 0!
    var yyyy = hj.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    hj = yyyy + '-' + mm + '-' + dd;
    document.getElementById("datanasc").setAttribute("max", hj);

});


$(document).ready(function(){

    $("#espDiv").hide();

});

function verificaSmedico(value){


    var medico = document.getElementById('esp').value;
    if(value == "Medico"){

        $("#espDiv").show();
    }

    else {

        $("#espDiv").hide();
    }


}


function completa(){

    $('#medico').children('option:not(:first)').remove();
    $("#medico").prop("disabled", true);
    $("#horario").prop("disabled", true);
    $("#horario").val("0");


    var especialidade = document.getElementById("especialidade").value;

    if(especialidade != 0) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {

                // document.getElementById("teste").innerHTML = "success ajax: " + xhttp.responseText;

                //var nome = xhttp.responseText ;
                var nome = JSON.parse(xhttp.responseText);

                for (pos in nome) {
                    texto = nome[pos].nome;
                    var campoSelect = document.getElementById("medico");
                    var option = document.createElement("option");
                    option.text = texto;
                    option.value = texto;
                    campoSelect.add(option);

                }

                $("#medico").prop("disabled", false);
                // document.getElementById("teste").innerHTML = "success ajax final -: " + texto ;
                // document.getElementById("textoSugestao").innerHTML = xhttp.responseText;
            }
        }

        xhttp.open("GET", "completaAgendamento.php?q=" + especialidade, true);
        //document.getElementById("teste").innerHTML = "especialidade dento ajax: " + especialidade;
        xhttp.send();

    }

}
function dataHoje() {
    var hj = new Date();
    var dd = hj.getDate();
    var mm = hj.getMonth() + 1; //Janeiro é 0!
    var yyyy = hj.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    hj = yyyy + '-' + mm + '-' + dd;
    document.getElementById("data").setAttribute("min", hj);


}



function disableHora() {
    var med = document.getElementById('medico').value;
    if (med =! 0){

        var x = new XMLHttpRequest();
        x.onreadystatechange = function()
        {
            if (x.readyState == 4 && x.status == 200)
            {

                // document.getElementById("teste").innerHTML = " dento ajax inicio: " + x.responseText;

                //var nome = xhttp.responseText ;
                var nome = JSON.parse(x.responseText);


                for ( pos in nome) {
                    texto = nome[pos].hora; //texto = dado
                    texto = '#' + texto;
                   //  document.getElementById("teste").innerHTML = "hora dento ajax final: " + texto;
                    $(texto).attr("disabled", true);
                    $(texto).hide();
                }

                $("#horario").prop("disabled", false);

                // document.getElementById("teste").innerHTML = "success ajax final -: " + texto ;
                // document.getElementById("textoSugestao").innerHTML = xhttp.responseText;
            }
        }

        var data = document.getElementById('data').value;
        var med = document.getElementById('medico').value;
        // var data = new Date($("#data").val());

        x.open("GET", "horaNdisponivel.php?q=" + data + "&nome=" + med, true);
        //   document.getElementById("teste").innerHTML = "data dento ajax: " + data + med ;
        x.send();
    }
}




function ativaHora() {
    var value = document.getElementById('especialidade').value;
    var medico = document.getElementById('medico').value;
    var data = document.getElementById('data').value;
    // document.getElementById("teste").innerHTML = "data dento ajax: " + data + data.length ;

    $("#horario").val("0");
    $("#horario").prop("disabled", true);

    for(var i=8; i<=17;i++){
        var seletor = '#' + i;
        $(seletor).attr("disabled", false);
        $(seletor).show();
    }

    if(value != 0  && medico != 0 && data.length != 0) {

        disableHora();
    }
}



window.onunload = fechaEstaAtualizaAntiga;
function fechaEstaAtualizaAntiga() {
    window.opener.location.reload();
}

function fecharAtual() {
    window.close();
}

function fechaAtual() {
    location.reload();
}

$(document).ready(function(){

    $("#espDiv").hide();

});


function buscaEndereco(cep)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function()
    {
        if (xhttp.readyState == 4 && xhttp.status == 200)
        {
            if (xhttp.responseText != "")
            {
                var endereco = JSON.parse(xhttp.responseText);

                document.forms[0]["logradouro"].value    = endereco.rua;
                document.forms[0]["cidade"].value = endereco.cidade;
                document.forms[0]["bairro"].value = endereco.bairro;
            }
        }
    }

    xhttp.open("GET", "buscaEndereco.php?cep=" + cep, true);
    xhttp.send();
}





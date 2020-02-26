<!DOCTYPE html>

<html lang="pt-br">
<head>
    <title>DKL Clínica</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/Style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/javascript.js"></script>

</head>

<body>
    <div class="container-fluid header">
        <div class="row">
            <div class="logo col-xs-12 col-md-2">
                <img src="img/logoazul-menor.png" alt="DKL Clínica">
            </div>
            <div class="endereco col-md-8 hidden-xs hidden-sm">
                <ul>
                    <li>Av. João Naves de Ávila, 2121</li>
                    <li>Uberlândia - MG</li>
                    <li>Fone: (34)0000-0000</li>
                </ul>
            </div>
            <div class="sociais-header col-md-2 hidden-xs hidden-sm">
                <ul>
                    <li><a href="https://www.facebook.com/"><img src="img/social-facebook-circular-button.png"></a></li>
                    <li><a href="https://www.linkedin.com/"><img src="img/social-linkedin-circular-button.png"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle botao-responsivo" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="nav navbar-nav login">
                    <a href="#"><button type="button" data-toggle="modal" data-target="#myModal">Login</button></a>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="galeria.php">GALERIA</a></li>
                    <li><a href="contato.php">CONTATO</a></li>
                    <li><a href="agendamento.php">AGENDAMENTO</a></li>
                </ul>
            </div>

        </div>

    </nav>

    <div class="modal-login">
        <?php
        include "modal.php";
        ?>
    </div>




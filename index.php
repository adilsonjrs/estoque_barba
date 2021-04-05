<?php
session_start();
if(!$_SESSION['usuario']) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/styles/style.css">
    <link rel="stylesheet" href="../styles/estoque.css">
    <title>Inicio / Estoque</title>
</head>
<body>
    <input type="checkbox" id="inputActive">
    <div class="sidebar">
        <div class="sidebar-marca">
            <h1>
                <i class="lab la-atlassian la-2x"></i>
                <span>Stock</span>
            </h1>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href=""><span class="las la-home la-2x"></span>
                    <span>Inicio</span></a>
                </li>
                <li>
                    <a href="src/pages/estoque.php"><span class="las la-archive la-2x"></span>
                    <span>Estoque</span></a>
                </li>
                <li>
                    <a href="#"><span class="las la-plus-circle la-2x"></span>
                    <span>Entrada de Produtos</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-chalkboard la-2x"></span>
                    <span>Relatório</span></a>
                </li>
                <li>
                    <a href="src/scripts/logout.php"><span class="las la-door-open la-2x"></span>
                    <span>Sair</span></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h1>
                <label for="inputActive">
                    <span class="las la-bars la-lg"></span>
                </label>
            </h1>
            <div class="user">
                <i class="lar la-user-circle la-2x"></i>
                <div>
                    <h4>Fernando H.</h4>
                </div>
                
            </div>
        </header>

        <div class="container-cards">
            <div class="cards">
                <div class="total-estoque">
                    <div class="total-estoque-itens">
                        <span>3052</span>
                        <span>Produtos em estoque</span>
                    </div>
                    <div class="icon-estoque">
                        <i class="las la-boxes la-3x"></i>
                    </div>
                </div>
                <div class="estoque-baixo">
                    <div class="total-estoque-itens">
                        <span>52</span>
                        <span>Produtos com estoque baixo</span>
                    </div>
                    <div class="icon-estoque-alert">
                        <i class="las la-exclamation-triangle la-3x"></i>
                    </div>
                    
                </div>
            </div>
        </div>


    </div>
</body>
</html>
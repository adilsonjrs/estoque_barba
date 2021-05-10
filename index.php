<?php
//verifica se existe uma sessão, caso não tenha, redireciona para o login.php
session_start();
if(!$_SESSION['user']) {
    header('Location: login.php');
}

include 'db/select_db.php';

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
    <link rel="stylesheet" href="src/styles/global.css">
    <link rel="stylesheet" href="src/styles/index.css">
    <title>Inicio / Estoque</title>
</head>
<body>
    <!--SIDEBAR-->
    <input type="checkbox" id="inputActive">

    <div class="contentSidebar">
        <div class="sidebar">
            <div class="sidebar-marca">
                <h1>
                    <i class="lab la-atlassian"></i>
                    <span id="checked">Stock</span>
                </h1>
            </div>
    
            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="index.php">
                            <span class="las la-home"></span>
                            <label>Inicio</label>
                            <span id="checked">Inicio</span>
                        </a>
                    </li>
                    <li>
                        <a href="src/pages/estoque.php">
                            <span class="las la-archive"></span>
                            <label>Estoque</label>
                            <span id="checked">Estoque</span>
                        </a>
                    </li>
                    <li>
                        <a href="src/pages/entradaProduto.php">
                            <span class="las la-plus-circle"></span>
                            <label>Entrada e Saída</label>
                            <span id="checked">Entrada e Saída</span>
                        </a>
                    </li>
                    <li>
                        <a href="" disable>
                            <span class="las la-chalkboard"></span>
                            <label>Relatório</label>
                            <span id="checked">Relatório</span>
                        </a>
                    </li>
                    <li>
                        <a href="src/scripts/logout.php">
                            <span class="las la-door-open"></span>
                            <label>Sair</label>
                            <span id="checked">Sair</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <!--HEADER-->
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
                    <h4><?= $_SESSION['user']?></h4>
                </div>
                
            </div>
        </header>

    <!--CONTENT CARDS-->

        <div class="container-cards">

            <div class="cards">
                <div class="total-estoque">
                    <div class="total-estoque-itens">
                    
                        <span> <?= $row2['quantidade'] ?> </span>
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

                <div class="estoque-baixo">
                    <div class="total-estoque-itens">
                        <span>120</span>
                        <span>Quantidade segura</span>
                    </div>
                    <div class="icon-estoque-alert">
                        <i class="las la-shield-alt la-3x"></i>
                    </div>
                </div>

            </div>

            <div></div>

        </div>


    </div>

    

</body>
</html>
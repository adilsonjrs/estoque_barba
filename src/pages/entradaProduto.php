<?php
//verifica se existe uma sessão, caso não tenha, redireciona para o login.php
session_start();
if(!$_SESSION['user']) {
    header('Location: ../../login.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/entradaProduto.css">
    <link rel="stylesheet" href="../styles/estoque.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap" rel="stylesheet">
    <title>Entrada de Produtos</title>
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
                        <a href="../../index.php">
                            <span class="las la-home"></span>
                            <label>Inicio</label>
                            <span id="checked">Inicio</span>
                        </a>
                    </li>
                    <li>
                        <a href="estoque.php">
                            <span class="las la-archive"></span>
                            <label>Estoque</label>
                            <span id="checked">Estoque</span>
                        </a>
                    </li>
                    <li>
                        <a href="entradaProduto.php">
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
                        <a href="../scripts/logout.php">
                            <span class="las la-door-open"></span>
                            <label>Sair</label>
                            <span id="checked">Sair</span>
                        </a>
                    </li>
                </ul>
            </div>
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
                    <h4><?= $_SESSION['user']?></h4>
                </div>
                
            </div>
        </header>

        <div class="opcaoEntrada">
            <div class="entradaManual">
                    <a href="EntradaManual.php"><i class="las la-arrow-circle-up"></i><span>Entrada Produtos</span></a>
            </div>
            <div class="entradaBarras">
                <a href=""><i class="las la-arrow-circle-down"></i><span>Saída Produtos</span></a>
                
            </div>
        </div>
        
    </div>
</body>
</html>
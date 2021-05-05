<?php
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
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/entradaManual.css">
    <title>Entrada Manual Estoque</title>
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
        <!--CONTENT MAIN-->
        <div class="infoHeader">
            <i class="las la-boxes"></i>
            <h2>Entrada de Produtos</h2>
        </div>
        <div class="containerEntrada">
                <form action="../../db/insert_db.php" method="post" class="containerSecao">
                    <div>
                        <div class="secao1">
                            <div>
                                <label for="codigo">Código</label>
                                <input type="text" name="codigo" id="codigo" placeholder="Código">
                            </div>
                            <div>
                                <label for="marca">Marca</label>
                                <input type="text" name="marca" id="marca" placeholder="Marca">
                            </div>
                            <div>
                                <label for="detalhes">Detalhes</label>
                                <input type="text" name="detalhes" id="detalhes" placeholder="Detalhes">
                            </div>
                        </div>

                        <div class="secao2">
                            <div>
                                <label for="produto">Produto</label>
                                <input type="text" name="produto" id="produto" placeholder="Produto">
                            </div>
                            <div>
                                <label for="fornecedor">Fornecedor</label>
                                <input type="text" name="fornecedor" id="fornecedor" placeholder="Fornecedor Principal">
                            </div>
                            <div>
                                <label for="operacaoFiscal">Operação Fiscal</label>
                                <select name="operacaoFiscal" id="operacaoFiscal">
                                    <option disabled selected value="">Operação Fiscal</option>
                                    <option value="1">Entrada de Fornecedor</option>
                                    <option value="2">Venda de Mercadorias</option>
                                </select>
                            </div>
                        </div>
                    </div>
                        
                    <div class="opcao">
                        <div>
                            <button formAction="EntradaManual.php">Novo Produto</button>
                        </div>
                        <div>
                            <button type="submit">Salvar</button>
                            <button formAction="../../index.php">Cancelar</button>
                        </div>
                    </div>
                </form>
            
        </div>
    </div>

</body>
</html>
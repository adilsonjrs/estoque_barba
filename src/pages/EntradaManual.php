<?php
//verifica se existe uma sessão, caso não tenha, redireciona para o login.php
include '../../db/conexao_db.php';
include '../../db/security.php';

// Set security headers
setSecurityHeaders();

// Check if user session is valid
if(!isValidSession()) {
    session_destroy();
    secureRedirect('../../login.php?error=session_expired');
}

// Generate CSRF token
$csrf_token = generateCSRFToken();

// Handle success/error messages
$message = '';
$message_type = '';
if (isset($_GET['success'])) {
    $message = 'Produto inserido com sucesso!';
    $message_type = 'success';
} elseif (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'missing_fields':
            $message = 'Preencha todos os campos obrigatórios.';
            break;
        case 'invalid_length':
            $message = 'Um ou mais campos excedem o tamanho máximo permitido.';
            break;
        case 'invalid_operation':
            $message = 'Operação fiscal inválida.';
            break;
        case 'insert_failed':
            $message = 'Erro ao inserir produto. Tente novamente.';
            break;
        case 'system_error':
            $message = 'Erro do sistema. Tente novamente mais tarde.';
            break;
        default:
            $message = 'Erro desconhecido.';
    }
    $message_type = 'error';
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
        
        <?php if ($message): ?>
            <div class="message <?php echo $message_type; ?>" style="margin: 15px 0; padding: 10px; border-radius: 4px; <?php echo $message_type === 'success' ? 'background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;' : 'background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        
        <div class="containerEntrada">
                <form action="../../db/insert_db.php" method="post" class="containerSecao">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                    <div>
                        <div class="secao1">
                            <div>
                                <label for="codigo">Código *</label>
                                <input type="text" name="codigo" id="codigo" placeholder="Código" required maxlength="50">
                            </div>
                            <div>
                                <label for="marca">Marca *</label>
                                <input type="text" name="marca" id="marca" placeholder="Marca" required maxlength="100">
                            </div>
                            <div>
                                <label for="detalhes">Detalhes *</label>
                                <input type="text" name="detalhes" id="detalhes" placeholder="Detalhes" required maxlength="255">
                            </div>
                        </div>

                        <div class="secao2">
                            <div>
                                <label for="produto">Produto *</label>
                                <input type="text" name="produto" id="produto" placeholder="Produto" required maxlength="100">
                            </div>
                            <div>
                                <label for="fornecedor">Fornecedor *</label>
                                <input type="text" name="fornecedor" id="fornecedor" placeholder="Fornecedor Principal" required maxlength="100">
                            </div>
                            <div>
                                <label for="operacaoFiscal">Operação Fiscal *</label>
                                <select name="operacaoFiscal" id="operacaoFiscal" required>
                                    <option disabled selected value="">Operação Fiscal</option>
                                    <option value="1">Entrada de Fornecedor</option>
                                    <option value="2">Venda de Mercadorias</option>
                                </select>
                            </div>
                        </div>
                    </div>
                        
                    <div class="opcao">
                        <div>
                            <button type="button" onclick="location.href='EntradaManual.php'">Novo Produto</button>
                        </div>
                        <div>
                            <button type="submit">Salvar</button>
                            <button type="button" onclick="location.href='../../index.php'">Cancelar</button>
                        </div>
                    </div>
                </form>
            
        </div>
    </div>

</body>
</html>
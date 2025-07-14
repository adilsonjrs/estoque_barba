<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/src/styles/login.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Login</title>
</head>
<body>
    <?php
    session_start();
    include_once 'db/security.php';
    
    // Set security headers
    setSecurityHeaders();
    
    // Generate CSRF token
    $csrf_token = generateCSRFToken();
    
    // Display error messages if any
    $error_message = '';
    if (isset($_GET['error'])) {
        switch ($_GET['error']) {
            case 'invalid_credentials':
                $error_message = 'Email ou senha inválidos.';
                break;
            case 'invalid_email':
                $error_message = 'Formato de email inválido.';
                break;
            case 'missing_fields':
                $error_message = 'Preencha todos os campos.';
                break;
            case 'rate_limit':
                $error_message = 'Muitas tentativas de login. Tente novamente em 15 minutos.';
                break;
            case 'session_expired':
                $error_message = 'Sua sessão expirou. Faça login novamente.';
                break;
            default:
                $error_message = 'Erro no login. Tente novamente.';
        }
    }
    ?>
    
    <form action="db/logar.php" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
        
        <div id="iconLogin">
            <i class="lab la-atlassian"></i>
            <span>Stock</span>
        </div>
        
        <?php if ($error_message): ?>
            <div class="error-message" style="color: #e74c3c; text-align: center; margin-bottom: 15px; padding: 10px; background-color: #fdf2f2; border: 1px solid #f5c6cb; border-radius: 4px;">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        
        <div class="contLogin">
            <div class="contentLogin">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required maxlength="255" autocomplete="email">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required maxlength="128" autocomplete="current-password">
            </div>
            <div class="button">
                <button type="submit">Entrar</button>
            </div>
        </div>
    </form>
    
</body>
</html>


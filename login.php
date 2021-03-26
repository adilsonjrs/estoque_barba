<?php
session_start();
include_once('src/scripts/login.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/src/styles/login.css">
    <title>Login</title>
</head>
<body>
    <form action="#" method="post">

        <div class="contLogin">
            <div class="contentLogin">
                <label for="user">Usuário</label>
                <input type="text" name="user" id="user">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha">
            </div>
            <div class="button">
                <button>Acessar</button>
            </div>
        </div>

    </form>
    
</body>
</html>


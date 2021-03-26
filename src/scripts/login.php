<?php

$login = $_POST['user'];
$senha = $_POST['senha'];

$validaUsuario = 'Fernando_Henrique';
$validaSenha = 'henriquesantos';

if($login === $validaUsuario && $senha === $validaSenha) {
    $_SESSION['usuario'] = $validaUsuario['user'];
    header('Location: index.php');
}
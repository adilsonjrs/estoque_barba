<?php

session_start();

$servidor = '127.0.0.1';
$usuario = 'root';
$senha = 'root';
$db = 'estoque_barba';


try{
    $conn = new PDO("mysql:host=$servidor;dbname=$db", $usuario, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e) {
    die('Error: ' . $e->getMessage());
}

<?php

if(isset($_POST["email"]) && !empty($_POST["email"]) &&
   isset($_POST["senha"]) && !empty($_POST["senha"])){

    include_once "conexao_db.php";

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM usuarios WHERE email=:email AND senha=:senha";

    $consulta = $conn->prepare($sql);
    $consulta->bindValue(":email", $email);
    $consulta->bindValue(":senha", md5($senha));
    $consulta->execute();

    if($consulta->rowCount() > 0){
      $result = $consulta->fetch();
      //cria sessão do usuário
      $_SESSION['user'] = $result['nome'];
      header('Location: ../index.php');
    }

    $conn = null;

  }else{
    header("Location: ../login.php");
}
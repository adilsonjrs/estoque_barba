<?php

if( isset($_POST['codigo']) && !empty($_POST["codigo"])&&
    isset($_POST['marca']) && !empty($_POST["marca"])&&
    isset($_POST['detalhes']) && !empty($_POST["detalhes"])&&
    isset($_POST['produto']) && !empty($_POST["produto"])&&
    isset($_POST['fornecedor']) && !empty($_POST["fornecedor"])&&
    isset($_POST['operacaoFiscal']) && !empty($_POST["operacaoFiscal"])){

        include_once 'conexao_db.php';

        $codigo = $_POST['codigo'];
        $marca = $_POST['marca'];
        $detalhes = $_POST['detalhes'];
        $produto = $_POST['produto'];
        $fornecedor = $_POST['fornecedor'];
        $operacaoFiscal = $_POST['operacaoFiscal'];

        $sql = "INSERT INTO entrada_produtos (codigo, marca, detalhes, produto, fornecedor, operacaoFiscal) 
                VALUES(:codigo, :marca, :detalhes, :produto, :fornecedor, :operacaoFiscal)";

        $inserir = $conn->prepare($sql);
        $inserir->bindValue(":codigo", $codigo);
        $inserir->bindValue(":marca", $marca);
        $inserir->bindValue(":detalhes", $detalhes);
        $inserir->bindValue(":produto", $produto);
        $inserir->bindValue(":fornecedor", $fornecedor);
        $inserir->bindValue(":operacaoFiscal", $operacaoFiscal);

        if($inserir->execute()){
            header('Location: ../src/pages/EntradaManual.php');
        }

        $conn = null;
        
    }else {
        header('Location: EntradaManual.php');
    }



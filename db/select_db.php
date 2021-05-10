<?php

include_once 'conexao_db.php';

//Mostra todos os produtos do estoque

$sql = 'SELECT * FROM entrada_produtos';

$consulta = $conn->prepare($sql);
$consulta->execute();
$result = [];

if($consulta->rowCount() > 0) {
    while($row = $consulta->fetch(PDO::FETCH_ASSOC)){
        $result[] = $row;
    }
}

//Mostra a quantidade total de produtos

$sql2 = 'SELECT SUM(quantidadeProdutos) AS quantidade FROM entrada_produtos';

$consulta2 = $conn->prepare($sql2);
$consulta2->execute();

$row2 = $consulta2->fetch(PDO::FETCH_ASSOC);



$conn = null;




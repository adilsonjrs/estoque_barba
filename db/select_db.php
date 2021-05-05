<?php

include_once 'conexao_db.php';

$sql = 'SELECT * FROM entrada_produtos';

$consulta = $conn->prepare($sql);
$consulta->execute();
$result = [];

if($consulta->rowCount() > 0) {
    while($row = $consulta->fetch(PDO::FETCH_ASSOC)){
        $result[] = $row;
    }
}


$conn = null;




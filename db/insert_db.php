<?php

include_once 'conexao_db.php';
include_once 'security.php';

// Set security headers
setSecurityHeaders();

// Check if user session is valid
if(!isValidSession()) {
    session_destroy();
    secureRedirect('../login.php?error=session_expired');
}

// Verify CSRF token if present (should be added to forms)
if (isset($_POST['csrf_token']) && !verifyCSRFToken($_POST['csrf_token'])) {
    secureRedirect('../src/pages/EntradaManual.php?error=invalid_request');
}

// Check if all required fields are present and not empty
if( !isset($_POST['codigo']) || empty(trim($_POST["codigo"])) ||
    !isset($_POST['marca']) || empty(trim($_POST["marca"])) ||
    !isset($_POST['detalhes']) || empty(trim($_POST["detalhes"])) ||
    !isset($_POST['produto']) || empty(trim($_POST["produto"])) ||
    !isset($_POST['fornecedor']) || empty(trim($_POST["fornecedor"])) ||
    !isset($_POST['operacaoFiscal']) || empty(trim($_POST["operacaoFiscal"]))){

    secureRedirect('../src/pages/EntradaManual.php?error=missing_fields');
}

try {
    // Sanitize and validate input data
    $codigo = sanitizeInput($_POST['codigo']);
    $marca = sanitizeInput($_POST['marca']);
    $detalhes = sanitizeInput($_POST['detalhes']);
    $produto = sanitizeInput($_POST['produto']);
    $fornecedor = sanitizeInput($_POST['fornecedor']);
    $operacaoFiscal = (int)$_POST['operacaoFiscal'];

    // Additional validation
    if (strlen($codigo) > 50 || strlen($marca) > 100 || strlen($detalhes) > 255 || 
        strlen($produto) > 100 || strlen($fornecedor) > 100) {
        secureRedirect('../src/pages/EntradaManual.php?error=invalid_length');
    }

    if (!in_array($operacaoFiscal, [1, 2])) {
        secureRedirect('../src/pages/EntradaManual.php?error=invalid_operation');
    }

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
        secureRedirect('../src/pages/EntradaManual.php?success=1');
    } else {
        secureRedirect('../src/pages/EntradaManual.php?error=insert_failed');
    }

} catch (PDOException $e) {
    // Log error securely
    error_log("Insert error: " . $e->getMessage());
    secureRedirect('../src/pages/EntradaManual.php?error=system_error');
}

$conn = null;



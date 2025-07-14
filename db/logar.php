<?php

include_once "conexao_db.php";
include_once "security.php";

// Set security headers
setSecurityHeaders();

// Check if all required fields are present
if(!isset($_POST["email"]) || empty($_POST["email"]) ||
   !isset($_POST["senha"]) || empty($_POST["senha"]) ||
   !isset($_POST["csrf_token"]) || empty($_POST["csrf_token"])){
    secureRedirect("../login.php?error=missing_fields");
}

// Verify CSRF token
if (!verifyCSRFToken($_POST["csrf_token"])) {
    secureRedirect("../login.php?error=invalid_request");
}

// Get client IP for rate limiting
$client_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

// Check rate limiting
if (!checkRateLimit($client_ip)) {
    secureRedirect("../login.php?error=rate_limit");
}

// Sanitize input data
$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
$senha = trim($_POST["senha"]);

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    logFailedLogin($client_ip);
    secureRedirect("../login.php?error=invalid_email");
}

// Validate password length (basic check)
if (strlen($senha) < 1 || strlen($senha) > 128) {
    logFailedLogin($client_ip);
    secureRedirect("../login.php?error=invalid_credentials");
}

try {
    // First get user by email only
    $sql = "SELECT id, nome, email, senha FROM usuarios WHERE email=:email LIMIT 1";

    $consulta = $conn->prepare($sql);
    $consulta->bindValue(":email", $email);
    $consulta->execute();

    if($consulta->rowCount() > 0){
        $user = $consulta->fetch();
        
        // Verify password using password_verify for new passwords or fallback to MD5 for existing ones
        $password_valid = false;
        
        // Check if password starts with $2y$ (bcrypt hash)
        if (substr($user['senha'], 0, 4) === '$2y$') {
            // New bcrypt password
            $password_valid = password_verify($senha, $user['senha']);
        } else {
            // Legacy MD5 password - verify and upgrade
            if (md5($senha) === $user['senha']) {
                $password_valid = true;
                
                // Upgrade to bcrypt hash
                $new_hash = password_hash($senha, PASSWORD_DEFAULT);
                $update_sql = "UPDATE usuarios SET senha=:nova_senha WHERE id=:id";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bindValue(":nova_senha", $new_hash);
                $update_stmt->bindValue(":id", $user['id']);
                $update_stmt->execute();
            }
        }

        if($password_valid){
            // Regenerate session ID for security
            session_regenerate_id(true);
            
            // Clear any existing login attempts for this IP
            unset($_SESSION['login_attempts']);
            
            //Create user session with additional security data
            $_SESSION['user'] = $user['nome'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['login_time'] = time();
            $_SESSION['last_activity'] = time();
            
            secureRedirect("../index.php");
        } else {
            logFailedLogin($client_ip);
            secureRedirect("../login.php?error=invalid_credentials");
        }
    } else {
        logFailedLogin($client_ip);
        secureRedirect("../login.php?error=invalid_credentials");
    }

} catch (PDOException $e) {
    // Log error securely
    error_log("Login error: " . $e->getMessage());
    logFailedLogin($client_ip);
    secureRedirect("../login.php?error=system_error");
}

$conn = null;
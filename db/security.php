<?php

/**
 * Security helper functions for the estoque_barba application
 */

/**
 * Generate CSRF token
 */
function generateCSRFToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 */
function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Check if user session is valid and not expired
 */
function isValidSession() {
    if (!isset($_SESSION['user']) || !isset($_SESSION['login_time']) || !isset($_SESSION['last_activity'])) {
        return false;
    }
    
    // Check if session is expired (24 hours)
    $session_lifetime = 24 * 60 * 60; // 24 hours
    if (time() - $_SESSION['login_time'] > $session_lifetime) {
        return false;
    }
    
    // Check if user has been inactive for too long (2 hours)
    $inactive_timeout = 2 * 60 * 60; // 2 hours
    if (time() - $_SESSION['last_activity'] > $inactive_timeout) {
        return false;
    }
    
    // Update last activity
    $_SESSION['last_activity'] = time();
    return true;
}

/**
 * Secure redirect function to prevent header injection
 */
function secureRedirect($url) {
    // Basic validation to prevent header injection
    $url = filter_var($url, FILTER_SANITIZE_URL);
    if (filter_var($url, FILTER_VALIDATE_URL) === false && !preg_match('/^[a-zA-Z0-9\/_.-]+\.php(\?[a-zA-Z0-9=&_-]+)?$/', $url)) {
        $url = 'index.php'; // Fallback to safe page
    }
    header("Location: $url");
    exit();
}

/**
 * Sanitize input data
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Set security headers
 */
function setSecurityHeaders() {
    // Prevent clickjacking
    header('X-Frame-Options: DENY');
    
    // Prevent MIME type sniffing
    header('X-Content-Type-Options: nosniff');
    
    // Enable XSS filtering
    header('X-XSS-Protection: 1; mode=block');
    
    // Enforce HTTPS (if available)
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }
    
    // Content Security Policy
    header("Content-Security-Policy: default-src 'self'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://maxst.icons8.com; font-src 'self' https://fonts.gstatic.com; script-src 'self'; img-src 'self' data:;");
}

/**
 * Rate limiting for login attempts
 */
function checkRateLimit($identifier) {
    $max_attempts = 5;
    $time_window = 15 * 60; // 15 minutes
    
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = [];
    }
    
    $current_time = time();
    $attempts = $_SESSION['login_attempts'];
    
    // Clean old attempts
    $attempts = array_filter($attempts, function($attempt_time) use ($current_time, $time_window) {
        return ($current_time - $attempt_time) < $time_window;
    });
    
    // Check if user has exceeded max attempts
    $user_attempts = array_filter($attempts, function($attempt) use ($identifier) {
        return $attempt['ip'] === $identifier;
    });
    
    if (count($user_attempts) >= $max_attempts) {
        return false;
    }
    
    return true;
}

/**
 * Log failed login attempt
 */
function logFailedLogin($identifier) {
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = [];
    }
    
    $_SESSION['login_attempts'][] = [
        'ip' => $identifier,
        'time' => time()
    ];
}
<?php
/* security.php */
// if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Secure Headers
// header("X-Content-Type-Options: nosniff");
// header("X-Frame-Options: DENY");
// header("X-XSS-Protection: 1; mode=block");
// header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
// header("Referrer-Policy: no-referrer-when-downgrade");
// header("Permissions-Policy: geolocation=(), microphone=(), camera=(), interest-cohort=()");

// CSRF Protection
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function validateCsrfToken($token) {
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        die("Invalid CSRF token");
    }
}

// Enforce HTTPS
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    // header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
}

// Prevent Session Hijacking
if (!isset($_SESSION['IPaddress'])) {
    $_SESSION['IPaddress'] = $_SERVER['REMOTE_ADDR'];
}
if (!isset($_SESSION['UserAgent'])) {
    $_SESSION['UserAgent'] = $_SERVER['HTTP_USER_AGENT'];
}
if ($_SESSION['IPaddress'] !== $_SERVER['REMOTE_ADDR'] || $_SESSION['UserAgent'] !== $_SERVER['HTTP_USER_AGENT']) {
    session_unset();
    session_destroy();
    die("Session hijacking attempt detected");
}

// Secure Cookies
ini_set("session.cookie_httponly", 1);
ini_set("session.cookie_secure", 1);
ini_set("session.use_only_cookies", 1);
session_regenerate_id(true);

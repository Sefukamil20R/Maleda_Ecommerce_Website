<?php
session_start();

$redirect_to = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : 'index.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?redirect_to=$redirect_to");
    exit();
} else {
    header("Location: $redirect_to");
    exit();
}
?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function checkRole($requiredRole)
{
    if (!isset($_SESSION['szerepkor']) || $_SESSION['szerepkor'] != $requiredRole) {
        header("Location: login.php");
        exit;
    }
}

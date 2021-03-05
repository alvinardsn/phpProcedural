<?php 
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();

    setcookie('id', '', time() - 36000);
    setcookie('key', '', time() - 36000);

    header("Location: login.php");
    exit;
?>
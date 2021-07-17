<?php
    session_start();
    $_SESSION["authorized"] = false;

    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];
    
    header("Location: ".$uri."/xander/admin/");
?>
<?php
    session_start();
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];

    if (!$_SESSION["authorized"]) {
        header("Location: ".$uri."/xander/admin/login");
    } else { 
        $link = mysqli_connect("localhost", "onejoy", "password", "onejoy");

        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        if (isset($_GET["order_id"])) {
            $order_id = $_GET["order_id"];
        } else {
            header("Location: ".$uri."/xander/admin/dashboard");
        }

        $sql = "UPDATE orders SET confirmed = !confirmed WHERE order_id = $order_id";
        $data = mysqli_query($link, $sql);

        header("Location: ".$uri."/xander/admin/dashboard/vieworder.php?order_id=".$order_id);
    }
?>
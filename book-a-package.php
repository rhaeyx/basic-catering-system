<?php 
    /* Attempt MySQL server connection. Assuming you are running MySQL
    server with default setting (user 'root' with no password)(localhost, username, password, database) */
    $link = mysqli_connect("localhost", "onejoy", "password", "onejoy");
    
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $package = $_POST["package"];
    $message = $_POST["message"];
    
    // Attempt insert query execution
    $sql = "INSERT INTO orders (name, email, contact, date, time, package, confirmed, message) VALUES ('$name', '$email', '$phone', '$date', '$time', '$package', 0, '$message')";
    if(mysqli_query($link, $sql)){
        echo "Your booking request was sent. We will call back or send an Email to confirm your reservation. Thank you!";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    
    // Close connection
    mysqli_close($link);
?>

<?php 
    session_start();

    $_SESSION["invalid"] = false;

    if (isset($_SESSION["authorized"])) {
        if ($_SESSION["authorized"]) {
            header("Location: ".$uri."/xander/admin/dashboard");
        }
    } else {
        $_SESSION["authorized"] = false;
    }
    

    if (!empty($_POST["submit"])) {
        $user = $_POST["user"];
        $pass = $_POST["pass"];

        if ($user == "admin" && $pass == "password") {
            $_SESSION["authorized"] = true;
            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header("Location: ".$uri."/xander/admin/dashboard");
        }
        else {
            $_SESSION["invalid"] = true;
            $_SESSION["authorized"] = false;
        }
    }
?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Yinka Enoch Adedokun">
	<title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
	<div class="login-wrap">
    <?php
        if ($_SESSION["invalid"]) {
            echo '<div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
            <strong>Invalid Login!</strong> Username and password does not match. <br>
            Try again.
            </div>';
        }
    ?>
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
		<form class="login-form" action="index.php" method="POST">
			<div class="sign-in-htm">
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user" name="user" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" name="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<input id="submit" name="submit" type="submit" class="button" value="Sign In">
				</div>
				<div class="hr"></div>
			</div>
		</form>
	</div>
    </div>
</body>
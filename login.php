<?php
session_start();
if(isset($_POST['cancel'])){
    header("Location: index.php");
    return ;
}

$pass = 'XyZzy12*_';
$stored_hash = hash('md5', 'XyZzy12*_php123');

$failure = false;
if(isset($_POST['email']) && isset($_POST['pass'])){
    if(isset($_POST['email']) < 1 && isset($_POST['pass']) < 1){
        $_SESSION['error'] = "Email and Password are Required";
    }else if (strpos($_POST['email'], "@") === false ){
        $_SESSION['error'] = "Email must have an at-sign @";
        header("Location: login.php");
            return;
    }else {
        $check = hash('md5', $pass . $_POST['pass'] );
        if ($check == $stored_hash){
            error_log("success login". $_POST['email']);
            $_SESSION['name'] = $_POST['email'];
            header("Location: view.php");
            return;
        }else {
            $_SESSION['error'] = "Incorrect password";
            error_log("Login fail ".$_POST['email']." $check");
            header("Location: login.php");
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">

<title>Ngô Lê Quân</title>
</head>
<body>
<div class="container">
    <h1>Please Log In</h1>
    <?php
     if ( isset($_SESSION['error']) ) {
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        
    }

?>
    <form method="POST" action="login.php">
        <label>Email : </label>
        <input type="text" name="email" />
        <label>Password</label>
        <input type="password" name="pass" />
        <input type="submit" value="Log In">
        <input type="submit"  name="cancel" value="cancel" />
    </form>
    <p>
        For a password hint, view source and find a password hint
        in the HTML comments.
        <!-- Hint: The password is the four character sound a cat
        makes (all lower case) followed by 123. -->
    </p>
</div>
</body>

<?php

session_start();

require('classes/db.php');

$db = new DB();

$mail = "";

if(isset($_SESSION['create_account_logged_in'])){

    $mail = $_SESSION['create_account_logged_in'];

    $_SESSION['forgot_user_msg'] = "A mail has been sent to you, please remember to check your spam folder.";

    header("location: reset.php");

}
else if(isset($_POST['email'])){

    $mail = $_POST['email'];

    $_SESSION['forgot_user_msg'] = "A mail has been sent to you, please remember to check your spam folder.";

}
else{

    header("location: forgot_account.php");

    $_SESSION['forgot_user_msg'] = "Something went wrong. Try again.";

}

var_dump($_POST['email']);

$db->email_key_gen($mail);

?>
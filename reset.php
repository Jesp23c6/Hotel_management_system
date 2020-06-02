<?php 
    session_start();

    error_reporting(1);

    include('connection.php');

    require('classes/db.php');

    $db = new DB();

    $key = "";

    if(isset($_SESSION['create_account_logged_in'])){

        $eid = $_SESSION['create_account_logged_in'];

    }

    if(isset($_GET['key'])){

        $key = $_GET['key'];

    }
    else if(isset($eid)){

        $key = $db->get_email_key($eid);

    }

    extract($_REQUEST);

    if(isset($update)){

        $testmsg = "";

        $mail_check = $db->check_password_reset($mail, $key);
        if($mail_check == true){

            $testmsg = "Correct mail key";

            $password = md5($salt . $pass);

            $db->update_password($mail, $password);

            $db->email_key_gen($mail);

            header("location: profile.php");

        }
        else{

            $testmsg = "False mail key";

        }

    }

    var_dump($testmsg);
    var_dump($mail_check);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Hotel.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai" rel="stylesheet">
</head>

<body style="margin-top:50px;">

    <?php
        include('includes/menu_bar.php');
    ?>

    <?php

        $sql= mysqli_query($con,"select * from create_account where email='$eid' "); 
        $result=mysqli_fetch_assoc($sql);

    ?>
    <div class="container-fluid" id="primary">
        <!--Primary Id-->
        <center>
            <h1
                style="background-color:#ed2553;border-radius:50px;font-family: 'Baloo Bhai', cursive;box-shadow:5px 5px 9px blue;text-shadow:2px 2px#000;display:inline-block;">
                User Profile</h1>
        </center><br>
        <div class="container">
            <div class="row">
                <center><?php  echo $msg; ?></center>
                <form class="form-horizontal" method="post">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <div class="row">
                                <div class="control-label col-sm-4">
                                    <h4>Email:</h4>
                                </div>
                                <div class="col-sm-8">
                                    <?php

                                        if(isset($eid)){
                                            echo('<input type="text" name="mail" value="' . $eid . '" class="form-control">');
                                        }
                                        else{
                                            echo('<input type="text" name="mail" class="form-control">');
                                        }

                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="control-label col-sm-4">
                                    <h4>New password:</h4>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="pass"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6" style="text-align:right;"><br>
                                    <input type="submit" value="Update Profile" name="update"
                                        class="btn btn-success btn-group-justified" required
                                        style="color:#000;font-family: 'Baloo Bhai', cursive;height:40px;" />
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--User Profile Update Query-->
                </form>
            </div>
        </div>
    </div>

  <?php
    include('includes/footer.php');
  ?>

</body>

</html>
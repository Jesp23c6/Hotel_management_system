<?php 
  session_start();

  error_reporting(1);

  include('connection.php');

  require("classes/db.php");

  $db = new DB();

  $eid=$_SESSION['create_account_logged_in'];

  extract($_REQUEST);

  if(isset($update)){

    $db->update_profile($name, $mob, $add, $eid);

    $message= "<h3 style='color:blue'>Profile Updated successfully</h3>";

  }
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

    $result = $db->get_user_info($eid);

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
                <center><?php  echo $message; ?></center>
                <form class="form-horizontal" method="post">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="control-label col-sm-4">
                                    <h4> Name :</h4>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="name" value="<?php echo $result['name']; ?>"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="control-label col-sm-4">
                                    <h4>Email-Id:</h4>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" value="<?php echo $result['email']; ?>" class="form-control"
                                        /readonly="readonly">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="control-label col-sm-4">
                                    <h4>Mobile:</h4>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="mob" value="<?php echo $result['mobile']; ?>"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="control-label col-sm-4">
                                    <h4>Address:</h4>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="add" value="<?php echo $result['address']; ?>"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="control-label col-sm-4">
                                    <h4>Gender:</h4>
                                </div>
                                <div class="col-sm-8">
                                    <strong><?php echo $result['gender']; ?></strong>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="control-label col-sm-5"></div>
                                <div class="col-sm-7	">
                                    <input type="submit" value="Update Profile" name="update" class="btn btn-primary" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="control-label col-sm-5"></div>
                                <div class="col-sm-7	">
                                    <a href="reset.php" class="btn btn-primary">Change password</a>
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
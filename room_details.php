<?php

  session_start();

  require('classes/db.php');

  $db = new DB();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Online Hotel.Com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
</head>

<body style="margin-top:50px;">

  <?php
    include('includes/menu_bar.php');
  ?>

  <?php 

    $room_id=$_GET['room_id'];

    $res = $db->get_room($room_id);
    
  ?>

    <br><br><br>
    <div class="container-fluid" style="margin-top:2%;">
        <div class="continer">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-7">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                            <li data-target="#myCarousel" data-slide-to="4"></li>
                            <li data-target="#myCarousel" data-slide-to="5"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">

                          <?php

                            //This adds two empty array indexes.
                            $files = scandir("image/".$res['type']);

                            $counter = 1;

                            //This removes the two first empty indexes in the array.
                            array_shift($files);
                            array_shift($files);

                            //Cycles through the files to use them for the carousel. This is flexible for any picture file type as well.
                            foreach($files as $file){

                              //To make sure the first picture is the 'active' one, I depend on the $counter variable.
                              if($counter == 1){

                                echo("
                                <div class='item active'>
                                <img src='image/" . $res['type'] . "/" . $file . "' class='thumbnail' alt='img" . $counter . "'>
                                </div>
                                ");

                                $counter = $counter + 1;

                              }
                              else{

                                echo("
                                <div class='item'>
                                <img src='image/" . $res['type'] . "/" . $file . "' class='thumbnail' alt='img" . $counter . "'>
                                </div>
                                ");

                                $counter = $counter + 1;

                              }

                            }

                          ?>

                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <h2 class="Ac_Room_Text"><?php echo $res['type']; ?></h2>

                    <?php

                      if($res['type'] !== "Parking Area"){

                        echo("<h3 class='Ac_Room_Text'>" . $res['price'] . "</h3>");

                      }
                    ?>

                    <p class="text-justify">
                      <?php 

                        echo($res['details']); 
        
                      ?>
                    </p>
                    <div class="row">
                      <?php

                        if($res['type'] !== "Parking Area"){

                          echo('<h2>Amenities & Facilities</h2>
                          <img src="image/icon/wifi.png"class="img-responsive">');

                          echo('<a href="Login.php" class="btn btn-danger">Book Now</a><br><br>');

                        }
                        else{

                          echo('<br>');

                        }
                      ?>

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 align="center">Room Type</h4>
                        </div><br>
                        <div class="panel-body-right text-center">
                            <!--Fetch Mysql Database Select Query Room Details -->

                            <?php

                              $rooms = $db->all_rooms();

                              while($result1 = $rooms->fetch_assoc()){

                                echo("<a href=room_details.php?room_id=" . $result1['room_id'] . ">" . $result1['type'] . "</a><hr>");

                              }
                              
                            ?>
                            <!--Fetch Mysql Database Select Query Room Details -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <?php
    include('includes/footer.php')
  ?>

</body>

</html>
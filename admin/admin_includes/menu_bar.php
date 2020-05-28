<?php 
  session_start();
  error_reporting(1);
?>
<!--Menu Bar Close Here-->


<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img src="logo/logo2.png" /width="160px" height="40px"
                style="margin-top:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="../index.php" title="Home">Home</a></li>
                <li><a href="../about.php" title="About">About </a></li>
                <li><a href="../image_gallery.php" title="Gallery">Gallery </a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php" title="Admin Login"><span
                            class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Admin Login</a></li>

                <?php 
                  if($_SESSION['create_account_logged_in']!=""){
                ?>
                <?php 
                  } 
                ?>
            </ul>
        </div>
    </div>
</nav>

<!--Menu Bar Close Here-->